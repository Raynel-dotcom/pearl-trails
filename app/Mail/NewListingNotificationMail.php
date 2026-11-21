<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewListingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Listing $listing;

    /**
     * Create a new message instance.
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing->loadMissing(['user', 'destination', 'activities']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Pearl Trails] New Business Listed: ' . $this->listing->name . ' (' . $this->listing->type . ')',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-listing',
        );
    }
}
