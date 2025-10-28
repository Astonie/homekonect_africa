<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $property;

    /**
     * Create a new notification instance.
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
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
        return (new MailMessage)
            ->subject('Property Approved - ' . $this->property->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Great news! Your property listing has been approved.')
            ->line('Property: ' . $this->property->title)
            ->line('Location: ' . $this->property->location)
            ->line('Price: $' . number_format((float)$this->property->price, 2))
            ->action('View Property', url('/properties/' . $this->property->id))
            ->line('Your property is now live and visible to potential buyers and tenants.')
            ->salutation('Best regards, The HomeKonnect Team');
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
        ];
    }
}
