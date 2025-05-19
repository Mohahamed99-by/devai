<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestMailController extends Controller
{
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function sendTestMail()
    {
        try {
            // Vérifier la configuration SMTP
            $mailUsername = env('MAIL_USERNAME');
            $mailPassword = env('MAIL_PASSWORD');
            $mailHost = env('MAIL_HOST');
            $mailEnabled = env('MAIL_ENABLED', false);

            // Afficher les informations de configuration (sans le mot de passe complet)
            $configInfo = [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'MAIL_HOST' => $mailHost,
                'MAIL_PORT' => env('MAIL_PORT'),
                'MAIL_USERNAME' => $mailUsername,
                'MAIL_PASSWORD' => substr($mailPassword, 0, 3) . '...' . substr($mailPassword, -3),
                'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
                'MAIL_ADMIN_EMAIL' => env('MAIL_ADMIN_EMAIL'),
                'MAIL_ENABLED' => $mailEnabled ? 'true' : 'false'
            ];

            // Vérifier si la configuration est valide
            if (!$mailEnabled || empty($mailUsername) || empty($mailPassword) || empty($mailHost)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Configuration SMTP incomplète',
                    'config' => $configInfo
                ], 500);
            }

            $to = env('MAIL_ADMIN_EMAIL', 'mohamedtolba161@gmail.com');
            $subject = 'Test Email from DevsAI';
            $message = view('emails.test', [
                'name' => 'Admin',
                'content' => 'Ceci est un email de test pour vérifier la configuration de votre serveur de messagerie.'
            ])->render();

            // Essayer d'envoyer directement via Mail facade pour obtenir plus d'informations sur l'erreur
            try {
                \Illuminate\Support\Facades\Mail::html($message, function ($mail) use ($to, $subject) {
                    $mail->to($to);
                    $mail->subject($subject);
                    $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });

                Log::info('Email de test envoyé avec succès à ' . $to . ' via Mail facade');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Email de test envoyé avec succès à ' . $to . ' via Mail facade',
                    'config' => $configInfo
                ]);
            } catch (\Exception $mailException) {
                Log::error('Échec de l\'envoi d\'email via Mail facade: ' . $mailException->getMessage());

                // Essayer avec le service personnalisé
                $result = $this->mailService->sendEmail(
                    $to,
                    $subject,
                    $message
                );

                if ($result) {
                    Log::info('Email de test envoyé avec succès à ' . $to . ' via MailService');
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Email de test envoyé avec succès à ' . $to . ' via MailService',
                        'config' => $configInfo
                    ]);
                } else {
                    Log::error('Échec de l\'envoi de l\'email de test à ' . $to . ' via MailService');
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Échec de l\'envoi de l\'email de test via les deux méthodes',
                        'mail_facade_error' => $mailException->getMessage(),
                        'config' => $configInfo
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de test: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l\'envoi de l\'email de test: ' . $e->getMessage()
            ], 500);
        }
    }
}
