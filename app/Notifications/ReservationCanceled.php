<?php
namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCanceled extends Notification
{
use Queueable;

protected $booking;

public function __construct(Booking $booking)
{
$this->booking = $booking;
}

public function via($notifiable)
{
    return ['mail', 'database']; // Add 'database' for storing notifications in the database

}

public function toMail($notifiable)
{
return (new MailMessage)
->line('Your booking for ' . $this->booking->car->model . ' has been canceled.')
->action('View Bookings', url('/bookings'))
->line('Thank you for using our application!');
}

public function toArray($notifiable)
{
return [
'message' => 'Your booking for ' . $this->booking->car->model . ' has been canceled.',
'booking_id' => $this->booking->id,
'created_at' => now()
];
}
}
