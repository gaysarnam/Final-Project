<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $statusMessage;
    public $cancellationMessage; // ✅ NEW property

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $statusMessage, $cancellationMessage = null) // ✅ Make optional
    {
        $this->booking = $booking;
        $this->statusMessage = $statusMessage;
        $this->cancellationMessage = $cancellationMessage; // ✅ Store it
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Booking Status Update - TN Resort')
                    ->view('emails.booking_status'); // ✅ The view automatically gets all public properties
    }
}