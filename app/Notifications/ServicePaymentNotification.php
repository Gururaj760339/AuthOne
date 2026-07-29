<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;

class servicePaymentNotification extends Notification
{

    use Queueable;
    public $booking;
    public $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking, $payment)
    {
        $this->booking = $booking;
        $this->payment = $payment;
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
            'title' => $this->booking->service->title . ' Payment Successful',
            'message' => 'Your payment for the '. $this->booking->service->title. ' service has been received.',
            'type' => 'services',
            'booking_id' => $this->booking->id,
            'payment_id' => $this->payment->id,
            'status' => 'paid',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->booking->service->title . ' Payment Successful')
            ->greeting('Hello ' . $notifiable->name)
            ->line('We have received your payment successfully.')
            ->line('Booking ID: ' . $this->booking->id)
            ->line('Payment ID: ' . $this->payment->id)
            ->action('View Payment', url('/payments'))
            ->line('Thank you for using AutoOne.');
    }


    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Payment received successfully for car wash booking #{$this->booking->id}."
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
