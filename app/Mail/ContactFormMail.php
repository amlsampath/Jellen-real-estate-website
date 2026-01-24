<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $propertyInterest;
    public $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $phone, $propertyInterest, $messageContent)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->propertyInterest = $propertyInterest;
        $this->messageContent = $messageContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Strictly validate email address - must be a valid email format
        $replyToEmail = filter_var($this->email, FILTER_VALIDATE_EMAIL);
        
        // Build the envelope with subject
        $subject = 'New Contact Form Submission from ' . ($this->name ?: 'Unknown');
        
        // Only set replyTo if we have a valid email address
        // Use just the email string (simplest approach - no name to avoid confusion)
        if ($replyToEmail && is_string($replyToEmail)) {
            return new Envelope(
                subject: $subject,
                replyTo: $replyToEmail,
            );
        }
        
        // If email is invalid, don't set replyTo
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
        );
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
