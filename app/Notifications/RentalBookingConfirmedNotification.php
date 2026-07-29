<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioSmsMessage;
use NotificationChannels\Twilio\TwilioChannel;


class RentalBookingConfirmedNotification extends Notification
{
    use Queueable;
    public $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
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
            ->subject('Car Rental Booking Confirmed')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your car rental booking has been confirmed.')
            ->line('Booking ID: ' . $this->booking->id)
            ->action('View Booking', url('/my-rental-bookings'))
            ->line('Thank you for choosing AutoOne.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Rental Booking Confirmed',
            'message' => 'Your rental booking has been confirmed.',
            'type' => 'rental_booking',
            'booking_id' => $this->booking->id
        ];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Your car rental booking (#{$this->booking->id}) has been confirmed."
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
