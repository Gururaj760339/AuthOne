<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;


class FinanceRequestNotification extends Notification
{
    use Queueable;

    public $finance;

    /**
     * Create a new notification instance.
     */
    public function __construct($finance)
    {
        $this->finance = $finance;
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

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Finance Request Submitted',
            'message' => 'Your finance request has been submitted successfully.',
            'type' => 'finance_request',
            'finance_request_id' => $this->finance->id
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Finance Request Submitted')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your finance request has been submitted successfully.')
            ->line('Reference No: FIN-' . $this->finance->id)
            ->action('View Request', url('/finance-requests'))
            ->line('We will review your application shortly.');
    }


    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Your finance request (FIN-{$this->finance->id}) has been submitted."
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
