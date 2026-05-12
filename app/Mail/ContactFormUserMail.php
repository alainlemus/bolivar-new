<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $contactName;
    public string $contactEmail;
    public string $contactPhone;
    public string $contactMessage;
    public ?string $logoUrl;

    public function __construct(
        string $contactName,
        string $contactEmail,
        string $contactPhone,
        string $contactMessage,
        ?string $logoUrl = null,
    ) {
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactPhone = $contactPhone;
        $this->contactMessage = $contactMessage;
        $this->logoUrl = $logoUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recibimos tu mensaje - Funeraria García de Bolívar',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-user',
        );
    }
}
