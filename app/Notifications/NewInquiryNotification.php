<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInquiryNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $property;
    protected $inquirerName;
    protected $inquirerEmail;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Property $property, $inquirerName, $inquirerEmail, $message)
    {
        $this->property = $property;
        $this->inquirerName = $inquirerName;
        $this->inquirerEmail = $inquirerEmail;
        $this->message = $message;
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
            ->subject('New Inquiry for ' . $this->property->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have received a new inquiry for your property.')
            ->line('Property: ' . $this->property->title)
            ->line('From: ' . $this->inquirerName . ' (' . $this->inquirerEmail . ')')
            ->line('Message:')
            ->line('"' . $this->message . '"')
            ->action('View Property', url('/properties/' . $this->property->id))
            ->line('Please respond to the inquiry at your earliest convenience.')
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
            'inquirer_name' => $this->inquirerName,
            'inquirer_email' => $this->inquirerEmail,
        ];
    }
}
