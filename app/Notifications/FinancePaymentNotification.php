<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;


class FinancePaymentNotification extends Notification
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Finance Payment Successful')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your finance payment has been completed successfully.')
            ->line('Reference No: FIN-' . $this->finance->id)
            ->action('View Details', url('/finance-requests'))
            ->line('Thank you for choosing AutoOne.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Finance Payment Successful',
            'message' => 'Your finance payment has been completed.',
            'type' => 'finance_payment',
            'finance_request_id' => $this->finance->id
        ];
    }


    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Finance payment completed successfully. Ref: FIN-{$this->finance->id}."
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
