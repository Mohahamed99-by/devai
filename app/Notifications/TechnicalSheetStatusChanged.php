<?php

namespace App\Notifications;

use App\Models\ClientResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TechnicalSheetStatusChanged extends Notification
{
    use Queueable;

    protected $clientResponse;
    protected $status;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(ClientResponse $clientResponse, string $status, string $message = null)
    {
        $this->clientResponse = $clientResponse;
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Statut de votre fiche technique mis à jour')
            ->line('Le statut de votre fiche technique a été mis à jour.')
            ->line('Nouveau statut: ' . $this->getStatusLabel())
            ->action('Voir la fiche technique', url('/client-response/' . $this->clientResponse->id))
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'client_response_id' => $this->clientResponse->id,
            'project_type' => $this->clientResponse->project_type ?? 'Projet',
            'status' => $this->status,
            'message' => $this->message ?? $this->getDefaultMessage(),
            'title' => $this->getTitle(),
            'type' => 'technical_sheet_status_changed',
            'created_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the status label.
     */
    protected function getStatusLabel(): string
    {
        return match($this->status) {
            'draft' => 'Brouillon',
            'validated' => 'Validé',
            default => ucfirst($this->status),
        };
    }

    /**
     * Get the default message based on status.
     */
    protected function getDefaultMessage(): string
    {
        return match($this->status) {
            'draft' => 'Votre fiche technique a été créée et est en attente de validation.',
            'validated' => 'Votre fiche technique a été validée par un administrateur.',
            default => 'Le statut de votre fiche technique a été mis à jour.',
        };
    }

    /**
     * Get the notification title.
     */
    protected function getTitle(): string
    {
        return match($this->status) {
            'draft' => 'Nouvelle fiche technique créée',
            'validated' => 'Fiche technique validée',
            default => 'Statut de fiche technique mis à jour',
        };
    }
}
