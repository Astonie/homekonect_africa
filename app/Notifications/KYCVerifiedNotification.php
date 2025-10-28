<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KYCVerifiedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($status = 'verified')
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->status === 'verified') {
            return (new MailMessage)
                ->subject('KYC Verification Approved')
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('Congratulations! Your KYC verification has been approved.')
                ->line('You now have full access to all HomeKonnect features.')
                ->action('Go to Dashboard', url('/dashboard'))
                ->line('Thank you for completing the verification process.')
                ->salutation('Best regards, The HomeKonnect Team');
        } else {
            return (new MailMessage)
                ->subject('KYC Verification Requires Attention')
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('Your KYC verification could not be approved at this time.')
                ->line('Please review your submitted documents and ensure they meet our requirements.')
                ->action('Update KYC Documents', url('/kyc'))
                ->line('If you have any questions, please contact our support team.')
                ->salutation('Best regards, The HomeKonnect Team');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'status' => $this->status,
        ];
    }
}
