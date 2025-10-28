<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $property;
    protected $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(Property $property, $reason = null)
    {
        $this->property = $property;
        $this->reason = $reason;
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
        $message = (new MailMessage)
            ->subject('Property Listing Requires Attention - ' . $this->property->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your property listing requires some modifications before it can be approved.')
            ->line('Property: ' . $this->property->title)
            ->line('Location: ' . $this->property->location);

        if ($this->reason) {
            $message->line('Reason: ' . $this->reason);
        }

        $message->line('Please review and update your listing with the necessary changes.')
            ->action('Edit Property', url('/agent/properties/' . $this->property->id . '/edit'))
            ->line('If you have any questions, please contact our support team.')
            ->salutation('Best regards, The HomeKonnect Team');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'property_id' => $this->property->id,
            'property_title' => $this->property->title,
            'reason' => $this->reason,
        ];
    }
}
