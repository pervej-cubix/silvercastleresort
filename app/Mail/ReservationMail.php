<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable

    {
        use Queueable, SerializesModels;
        public $data;
    
        /**
         * Create a new message instance.
         *
         * @param array $data
         */
        public function __construct(array $data) 
        {
            $this->data = $data;
        }
    
        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Reservation request from website',  // Subject of the email
            );
        }
    
        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'emails.reservation_mail',  // Ensure this view exists in resources/views/emails
                with: ['data' => $this->data],   // Pass the data to the view
            );
        }
    
        /**
         * Get the attachments for the message.
         *
         * @return array<int, \Illuminate\Mail\Mailables\Attachment>
         */
        public function attachments(): array
        {
            return [];  // If you want to attach any files, you can add them here
        }
}
