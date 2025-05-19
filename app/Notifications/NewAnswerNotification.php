<?php

namespace App\Notifications;

use App\Models\ClientResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnswerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $clientResponse;

    /**
     * Create a new notification instance.
     */
    public function __construct(ClientResponse $clientResponse)
    {
        $this->clientResponse = $clientResponse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle réponse reçue')
            ->view('emails.new-answer', [
                'clientResponse' => $this->clientResponse,
                'admin' => $notifiable
            ]);
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
            'project_type' => $this->clientResponse->project_type,
            'message' => 'Nouvelle réponse reçue pour le projet: ' . $this->clientResponse->project_type,
            'created_at' => now()->toDateTimeString()
        ];
    }
}