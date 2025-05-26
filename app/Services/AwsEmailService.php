<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Exception;

class AwsEmailService
{
    /**
     * Envoyer un email optimisé pour AWS
     *
     * @param string $to Adresse email du destinataire
     * @param string $subject Sujet de l'email
     * @param string $message Contenu HTML de l'email
     * @param string|null $from Adresse email de l'expéditeur
     * @param string|null $fromName Nom de l'expéditeur
     * @param string|null $replyTo Adresse email de réponse
     * @param string|null $replyToName Nom pour la réponse
     * @return bool Succès de l'envoi
     */
    public function sendEmail(
        string $to,
        string $subject,
        string $message,
        ?string $from = null,
        ?string $fromName = null,
        ?string $replyTo = null,
        ?string $replyToName = null
    ): bool {
        // Utiliser les valeurs par défaut si non fournies
        $from = $from ?: env('MAIL_FROM_ADDRESS', 'mohamedtolba161@gmail.com');
        $fromName = $fromName ?: env('MAIL_FROM_NAME', 'DevsAI Notifications');
        $replyTo = $replyTo ?: env('MAIL_REPLY_TO_ADDRESS', 'mohamedtolba161@gmail.com');
        $replyToName = $replyToName ?: env('MAIL_REPLY_TO_NAME', 'DevsAI Admin');

        // Log de début d'envoi
        Log::info('AWS Email Service - Début envoi', [
            'to' => $to,
            'subject' => $subject,
            'from' => $from,
            'environment' => app()->environment(),
            'timestamp' => now()->toISOString()
        ]);

        // 1. Essayer d'abord avec AWS SES si configuré
        if ($this->isAwsSesConfigured()) {
            try {
                $result = $this->sendViaAwsSes($to, $subject, $message, $from, $fromName, $replyTo, $replyToName);
                if ($result) {
                    Log::info("AWS Email Service - Email envoyé avec succès via AWS SES à {$to}");
                    return true;
                }
            } catch (Exception $e) {
                Log::error("AWS Email Service - Échec AWS SES: " . $e->getMessage());
            }
        }

        // 2. Fallback vers SMTP Gmail
        if ($this->isSmtpConfigured()) {
            try {
                $result = $this->sendViaSmtp($to, $subject, $message, $from, $fromName, $replyTo, $replyToName);
                if ($result) {
                    Log::info("AWS Email Service - Email envoyé avec succès via SMTP à {$to}");
                    return true;
                }
            } catch (Exception $e) {
                Log::error("AWS Email Service - Échec SMTP: " . $e->getMessage());
            }
        }

        // 3. Fallback vers Mailgun
        if ($this->isMailgunConfigured()) {
            try {
                $result = $this->sendViaMailgun($to, $subject, $message, $from, $fromName, $replyTo, $replyToName);
                if ($result) {
                    Log::info("AWS Email Service - Email envoyé avec succès via Mailgun à {$to}");
                    return true;
                }
            } catch (Exception $e) {
                Log::error("AWS Email Service - Échec Mailgun: " . $e->getMessage());
            }
        }

        Log::error("AWS Email Service - Tous les services d'envoi ont échoué pour {$to}");
        return false;
    }

    /**
     * Envoyer via AWS SES
     */
    protected function sendViaAwsSes(string $to, string $subject, string $message, string $from, string $fromName, string $replyTo, string $replyToName): bool
    {
        try {
            // Configuration AWS SES
            $region = env('AWS_DEFAULT_REGION', 'us-east-1');
            $accessKey = env('AWS_ACCESS_KEY_ID');
            $secretKey = env('AWS_SECRET_ACCESS_KEY');

            if (!$accessKey || !$secretKey) {
                return false;
            }

            // Utiliser le service SES de Laravel
            config(['mail.default' => 'ses']);
            config(['services.ses.key' => $accessKey]);
            config(['services.ses.secret' => $secretKey]);
            config(['services.ses.region' => $region]);

            Mail::html($message, function ($mail) use ($to, $subject, $from, $fromName, $replyTo, $replyToName) {
                $mail->to($to);
                $mail->subject($subject);
                $mail->from($from, $fromName);
                if ($replyTo) {
                    $mail->replyTo($replyTo, $replyToName);
                }
            });

            return true;
        } catch (Exception $e) {
            Log::error("AWS SES Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer via SMTP
     */
    protected function sendViaSmtp(string $to, string $subject, string $message, string $from, string $fromName, string $replyTo, string $replyToName): bool
    {
        try {
            // Forcer la configuration SMTP
            config(['mail.default' => 'smtp']);
            
            Mail::html($message, function ($mail) use ($to, $subject, $from, $fromName, $replyTo, $replyToName) {
                $mail->to($to);
                $mail->subject($subject);
                $mail->from($from, $fromName);
                if ($replyTo) {
                    $mail->replyTo($replyTo, $replyToName);
                }
            });

            return true;
        } catch (Exception $e) {
            Log::error("SMTP Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer via Mailgun
     */
    protected function sendViaMailgun(string $to, string $subject, string $message, string $from, string $fromName, string $replyTo, string $replyToName): bool
    {
        try {
            $domain = env('MAILGUN_DOMAIN');
            $secret = env('MAILGUN_SECRET');

            if (!$domain || !$secret) {
                return false;
            }

            $data = [
                'from' => "{$fromName} <{$from}>",
                'to' => $to,
                'subject' => $subject,
                'html' => $message,
            ];

            if ($replyTo) {
                $data['h:Reply-To'] = "{$replyToName} <{$replyTo}>";
            }

            $response = Http::withBasicAuth('api', $secret)
                ->post("https://api.mailgun.net/v3/{$domain}/messages", $data);

            return $response->successful();
        } catch (Exception $e) {
            Log::error("Mailgun Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Vérifier si AWS SES est configuré
     */
    protected function isAwsSesConfigured(): bool
    {
        return !empty(env('AWS_ACCESS_KEY_ID')) && 
               !empty(env('AWS_SECRET_ACCESS_KEY')) && 
               !empty(env('AWS_DEFAULT_REGION'));
    }

    /**
     * Vérifier si SMTP est configuré
     */
    protected function isSmtpConfigured(): bool
    {
        return env('MAIL_ENABLED', false) && 
               !empty(env('MAIL_USERNAME')) && 
               !empty(env('MAIL_PASSWORD')) && 
               !empty(env('MAIL_HOST'));
    }

    /**
     * Vérifier si Mailgun est configuré
     */
    protected function isMailgunConfigured(): bool
    {
        return !empty(env('MAILGUN_SECRET')) && !empty(env('MAILGUN_DOMAIN'));
    }

    /**
     * Obtenir le statut des services d'email
     */
    public function getEmailServicesStatus(): array
    {
        return [
            'aws_ses' => [
                'configured' => $this->isAwsSesConfigured(),
                'priority' => 1
            ],
            'smtp' => [
                'configured' => $this->isSmtpConfigured(),
                'priority' => 2
            ],
            'mailgun' => [
                'configured' => $this->isMailgunConfigured(),
                'priority' => 3
            ]
        ];
    }
}
