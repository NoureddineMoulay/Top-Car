<?php
namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
use Queueable, SerializesModels;

public $booking;

public function __construct(Booking $booking)
{
$this->booking = $booking;
}

public function build()
{
return $this->view('emails.reservation-confirmed')
->with([
'booking' => $this->booking,
]);
}
}
