<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;


class ImportPaymentNotification extends Notification
{
    use Queueable;
    public $import;

    /**
     * Create a new notification instance.
     */
    public function __construct($import)
    {
        $this->import = $import;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return [
            'mail',
            'database',
            //TwilioChannel::class,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Car Import Payment Successful')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your import payment has been received successfully.')
            ->line('Reference No: IMP-' . $this->import->id)
            ->action('View Details', url('/import-requests'))
            ->line('Thank you for choosing AutoOne.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Import Request Submitted',
            'message' => 'Your import request has been received.',
            'type' => 'import_request',
            'import_request_id' => $this->import->id
        ];
    }


    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Import payment completed successfully. Ref: IMP-{$this->import->id}."
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
