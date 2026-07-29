<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;


class RentalPaymentNotification extends Notification
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Car Rental Payment Successful')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your rental payment has been received successfully.')
            ->line('Booking ID: ' . $this->booking->id)
            ->line('Payment ID: ' . $this->payment->id)
            ->action('View Payment', url('/payments'))
            ->line('Thank you for choosing AutoOne.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Rental Payment Successful',
            'message' => 'Your rental payment has been completed.',
            'type' => 'rental_payment',
            'booking_id' => $this->booking->id
        ];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Payment received successfully for rental booking #{$this->booking->id}."
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
