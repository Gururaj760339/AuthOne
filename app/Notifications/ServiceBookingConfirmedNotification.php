<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;



class ServiceBookingConfirmedNotification extends Notification
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
            ->subject($this->booking->service->title .' Booking Confirmed')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your ' . $this->booking->service->title  . ' booking has been confirmed.')
            ->line('Booking ID: ' . $this->booking->id)
            ->action('View Booking', url('/my-workshop-bookings'))
            ->line('Thank you for choosing AutoOne.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->booking->service->title . ' Booking Confirmed',
            'message' => 'Your '. $this->booking->service->title .' booking has been confirmed.',
            'type' => 'services',
            'booking_id' => $this->booking->id,
            'status' => 'confirmed'
        ];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage)
            ->content(
                "AutoOne: Your workshop booking (#{$this->booking->id}) has been confirmed."
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
