<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMade extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param Booking $booking
     * @param string $pdfPath
     */
    public function __construct(Booking $booking, $pdfPath)
    {
        $this->booking = $booking;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.booking-made')
            ->with(['booking' => $this->booking])
            ->attach($this->pdfPath, [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
