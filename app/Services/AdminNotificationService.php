<?php

namespace App\Services;

use App\Models\ClientResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminNotificationService
{
    /**
     * Adresse email de l'administrateur
     *
     * @var string
     */
    protected $adminEmail;

    /**
     * Adresse email de l'expéditeur
     *
     * @var string
     */
    protected $fromEmail;

    /**
     * Nom de l'expéditeur
     *
     * @var string
     */
    protected $fromName;

    /**
     * Adresse email de réponse
     *
     * @var string
     */
    protected $replyToEmail;

    /**
     * Nom pour la réponse
     *
     * @var string
     */
    protected $replyToName;

    /**
     * Service d'envoi d'emails
     *
     * @var MailService
     */
    protected $mailService;

    /**
     * Service d'envoi d'emails AWS
     *
     * @var AwsEmailService
     */
    protected $awsEmailService;

    /**
     * Constructeur
     *
     * @param MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
        $this->awsEmailService = app(AwsEmailService::class);
        $this->adminEmail = env('MAIL_ADMIN_EMAIL', 'mohamedtolba161@gmail.com');
        $this->fromEmail = env('MAIL_FROM_ADDRESS', 'mohamedtolba161@gmail.com');
        $this->fromName = env('MAIL_FROM_NAME', 'DevsAI Notifications');
        $this->replyToEmail = env('MAIL_REPLY_TO_ADDRESS', 'mohamedtolba161@gmail.com');
        $this->replyToName = env('MAIL_REPLY_TO_NAME', 'DevsAI Admin');
    }

    /**
     * Envoie une notification unifiée par email à l'administrateur
     * Combine les informations de réponse et d'analyse en un seul email
     *
     * @param ClientResponse $clientResponse
     * @param string $userName
     * @return bool
     */
    public function sendUnifiedNotification(ClientResponse $clientResponse, string $userName): bool
    {
        try {
            // Vérifier si la configuration email est valide
            if (!$this->isEmailConfigured()) {
                return false;
            }

            // Obtenir les informations de l'utilisateur
            $userName = $clientResponse->user ? $clientResponse->user->name : $userName;
            $userEmail = $clientResponse->user ? $clientResponse->user->email : 'no-reply@devsai.com';

            // Préparer le contenu de l'email
            $subject = 'Nouvelle activité sur DevsAI - ' . $userName;

            // Générer le contenu HTML de l'email unifié
            $emailContent = view('emails.unified-notification', [
                'clientResponse' => $clientResponse,
                'admin' => ['name' => $this->replyToName],
                'userName' => $userName
            ])->render();

            // Envoyer l'email avec l'utilisateur comme expéditeur
            // Utiliser le service AWS en priorité, puis fallback vers le service standard
            $result = $this->awsEmailService->sendEmail(
                $this->adminEmail,
                $subject,
                $emailContent,
                $userEmail, // L'email apparaît comme envoyé par l'utilisateur
                $userName,  // Le nom de l'utilisateur comme expéditeur
                $userEmail, // Répondre directement à l'utilisateur
                $userName   // Nom pour la réponse
            );

            // Si le service AWS échoue, essayer avec le service standard
            if (!$result) {
                Log::warning('AWS Email Service a échoué, tentative avec MailService standard');
                $result = $this->mailService->sendEmail(
                    $this->adminEmail,
                    $subject,
                    $emailContent,
                    $userEmail,
                    $userName,
                    $userEmail,
                    $userName
                );
            }

            if ($result) {
                Log::info('Email de notification unifié envoyé avec succès', [
                    'client_response_id' => $clientResponse->id,
                    'recipient' => $this->adminEmail,
                    'sender' => $userEmail,
                    'subject' => $subject,
                    'project_type' => $clientResponse->project_type,
                    'has_ai_analysis' => !empty($clientResponse->ai_analysis_summary),
                    'timestamp' => now()->toISOString()
                ]);
            } else {
                Log::warning('Échec de l\'envoi de l\'email de notification unifié', [
                    'client_response_id' => $clientResponse->id,
                    'recipient' => $this->adminEmail,
                    'sender' => $userEmail,
                    'subject' => $subject,
                    'timestamp' => now()->toISOString()
                ]);

                // Tentative de retry après 5 secondes
                sleep(5);
                $retryResult = $this->awsEmailService->sendEmail(
                    $this->adminEmail,
                    '[RETRY] ' . $subject,
                    $emailContent,
                    $userEmail,
                    $userName,
                    $userEmail,
                    $userName
                );

                // Si AWS échoue encore, essayer avec le service standard
                if (!$retryResult) {
                    $retryResult = $this->mailService->sendEmail(
                        $this->adminEmail,
                        '[RETRY-FALLBACK] ' . $subject,
                        $emailContent,
                        $userEmail,
                        $userName,
                        $userEmail,
                        $userName
                    );
                }

                if ($retryResult) {
                    Log::info('Email de notification unifié envoyé avec succès après retry', [
                        'client_response_id' => $clientResponse->id
                    ]);
                    $result = true;
                } else {
                    Log::error('Échec définitif de l\'envoi de l\'email de notification unifié après retry', [
                        'client_response_id' => $clientResponse->id
                    ]);
                }
            }

            return $result;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de notification unifié', [
                'error' => $e->getMessage(),
                'client_response_id' => $clientResponse->id
            ]);

            return false;
        }
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * @deprecated Utiliser sendUnifiedNotification à la place
     */
    public function sendNewAnswerNotification(ClientResponse $clientResponse): bool
    {
        $userName = $clientResponse->user ? $clientResponse->user->name : 'Utilisateur anonyme';
        return $this->sendUnifiedNotification($clientResponse, $userName);
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * @deprecated Utiliser sendUnifiedNotification à la place
     */
    public function sendNewAnalysisNotification(ClientResponse $clientResponse, string $userName): bool
    {
        return $this->sendUnifiedNotification($clientResponse, $userName);
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * Cette méthode ne fait rien pour éviter les doublons d'emails
     *
     * @deprecated Utiliser sendUnifiedNotification à la place
     * @param User $user
     * @return bool
     */
    public function sendUserConnectionNotification(User $user): bool
    {
        // Ne rien faire pour éviter les doublons d'emails
        // Les informations de connexion seront incluses dans l'email unifié
        Log::info('Appel à sendUserConnectionNotification ignoré pour éviter les doublons d\'emails', [
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        return true;
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * @deprecated Utiliser sendUnifiedNotification à la place
     */
    protected function buildNewAnalysisEmailContent(ClientResponse $clientResponse, string $userName): string
    {
        // Cette méthode est obsolète et ne devrait plus être utilisée
        Log::warning('Appel à buildNewAnalysisEmailContent obsolète', [
            'client_response_id' => $clientResponse->id,
            'user_name' => $userName
        ]);

        // Retourner un message d'erreur au cas où cette méthode serait appelée
        return 'Cette méthode est obsolète. Utilisez sendUnifiedNotification à la place.';
    }

    /**
     * Méthode obsolète maintenue pour compatibilité
     * @deprecated Utiliser sendUnifiedNotification à la place
     */
    protected function buildUserConnectionEmailContent(User $user): string
    {
        // Cette méthode est obsolète et ne devrait plus être utilisée
        Log::warning('Appel à buildUserConnectionEmailContent obsolète', [
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        // Retourner un message d'erreur au cas où cette méthode serait appelée
        return 'Cette méthode est obsolète. Utilisez sendUnifiedNotification à la place.';
    }

    /**
     * Vérifier si la configuration email est valide
     *
     * @return bool
     */
    protected function isEmailConfigured(): bool
    {
        // Vérifier si l'email admin est configuré
        if (empty($this->adminEmail)) {
            Log::warning('Email administrateur non configuré');
            return false;
        }

        // Vérifier si au moins un service d'envoi d'email est configuré
        $smtpConfigured = !empty(env('MAIL_USERNAME')) && !empty(env('MAIL_PASSWORD')) && env('MAIL_ENABLED', false);
        $mailgunConfigured = !empty(env('MAILGUN_SECRET')) && !empty(env('MAILGUN_DOMAIN'));
        $sendgridConfigured = !empty(env('SENDGRID_API_KEY'));

        // Si aucun service n'est configuré, on log un avertissement mais on continue
        // car notre service alternatif tentera d'envoyer l'email
        if (!$smtpConfigured && !$mailgunConfigured && !$sendgridConfigured) {
            Log::warning('Aucun service d\'envoi d\'email n\'est correctement configuré. L\'envoi pourrait échouer.');
        }

        return true;
    }
}
