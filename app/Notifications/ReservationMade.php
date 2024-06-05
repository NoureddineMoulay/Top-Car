<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationMade extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database']; // Add 'database' for storing notifications in the database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reservation Confirmation')
            ->line('Your reservation for the car ' . $this->booking->car->name . ' is made successfully. Please proceed to payment.')
            ->action('View Reservation', url('/reservations/'.$this->booking->id))
            ->line('Thank you for using our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'car_name' => $this->booking->car->name,
            'message' => 'Your reservation for the car ' . $this->booking->car->model . ' is made successfully. Please proceed to payment.',
            'created_at' => $this->booking->created_at->toDateTimeString(),
        ];
    }
}
