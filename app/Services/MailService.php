<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class MailService
{
    /**
     * Envoyer un email
     *
     * @param string $to Adresse email du destinataire
     * @param string $subject Sujet de l'email
     * @param string $message Contenu HTML de l'email
     * @param string|null $from Adresse email de l'expéditeur (optionnel)
     * @param string|null $fromName Nom de l'expéditeur (optionnel)
     * @param string|null $replyTo Adresse email de réponse (optionnel)
     * @param string|null $replyToName Nom pour la réponse (optionnel)
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

        // Essayer d'envoyer l'email via SMTP
        if ($this->isSmtpConfigured()) {
            try {
                Mail::html($message, function ($mail) use ($to, $subject, $from, $fromName, $replyTo, $replyToName) {
                    $mail->to($to);
                    $mail->subject($subject);

                    if ($from) {
                        $mail->from($from, $fromName);
                    }

                    if ($replyTo) {
                        $mail->replyTo($replyTo, $replyToName);
                    }
                });

                Log::info("Email envoyé avec succès à {$to} via SMTP");
                return true;
            } catch (Exception $e) {
                Log::error("Échec de l'envoi d'email via SMTP: " . $e->getMessage());
                // Continuer avec les méthodes alternatives
            }
        }

        // Essayer d'envoyer via Mailgun si configuré
        if ($this->isMailgunConfigured()) {
            try {
                $domain = env('MAILGUN_DOMAIN');
                $data = [
                    'from' => "{$fromName} <{$from}>",
                    'to' => $to,
                    'subject' => $subject,
                    'html' => $message,
                ];

                // Ajouter l'en-tête Reply-To si fourni
                if ($replyTo && $replyToName) {
                    $data['h:Reply-To'] = "{$replyToName} <{$replyTo}>";
                } elseif ($replyTo) {
                    $data['h:Reply-To'] = $replyTo;
                }

                $response = Http::withBasicAuth('api', env('MAILGUN_SECRET'))
                    ->post("https://api.mailgun.net/v3/{$domain}/messages", $data);

                if ($response->successful()) {
                    Log::info("Email envoyé avec succès à {$to} via Mailgun");
                    return true;
                } else {
                    Log::error("Échec de l'envoi d'email via Mailgun: " . $response->body());
                }
            } catch (Exception $e) {
                Log::error("Erreur lors de l'envoi via Mailgun: " . $e->getMessage());
            }
        }

        // Essayer d'envoyer via SendGrid si configuré
        if ($this->isSendGridConfigured()) {
            try {
                $data = [
                    'personalizations' => [
                        [
                            'to' => [['email' => $to]],
                            'subject' => $subject,
                        ]
                    ],
                    'from' => [
                        'email' => $from,
                        'name' => $fromName
                    ],
                    'content' => [
                        [
                            'type' => 'text/html',
                            'value' => $message
                        ]
                    ]
                ];

                // Ajouter Reply-To si fourni
                if ($replyTo) {
                    $data['reply_to'] = [
                        'email' => $replyTo,
                        'name' => $replyToName
                    ];
                }

                $response = Http::withToken(env('SENDGRID_API_KEY'))
                    ->post('https://api.sendgrid.com/v3/mail/send', $data);

                if ($response->successful()) {
                    Log::info("Email envoyé avec succès à {$to} via SendGrid");
                    return true;
                } else {
                    Log::error("Échec de l'envoi d'email via SendGrid: " . $response->body());
                }
            } catch (Exception $e) {
                Log::error("Erreur lors de l'envoi via SendGrid: " . $e->getMessage());
            }
        }

        Log::warning("Aucune méthode d'envoi d'email n'a réussi pour {$to}");
        return false;
    }

    /**
     * Vérifier si SMTP est configuré
     *
     * @return bool
     */
    protected function isSmtpConfigured(): bool
    {
        $mailUsername = env('MAIL_USERNAME');
        $mailPassword = env('MAIL_PASSWORD');
        $mailHost = env('MAIL_HOST');
        $mailEnabled = env('MAIL_ENABLED', false);

        return $mailEnabled && !empty($mailUsername) && !empty($mailPassword) && !empty($mailHost);
    }

    /**
     * Vérifier si Mailgun est configuré
     *
     * @return bool
     */
    protected function isMailgunConfigured(): bool
    {
        return !empty(env('MAILGUN_SECRET')) && !empty(env('MAILGUN_DOMAIN'));
    }

    /**
     * Vérifier si SendGrid est configuré
     *
     * @return bool
     */
    protected function isSendGridConfigured(): bool
    {
        return !empty(env('SENDGRID_API_KEY'));
    }
}
