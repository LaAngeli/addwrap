<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        $business = (string) config('site.company.email');

        return new Envelope(
            subject: __('contact.confirmation.subject'),
            replyTo: [new Address($business, (string) config('site.company.name'))],
        );
    }

    /**
     * Headere RFC 3834 / Microsoft / Symfony — semnalează că e răspuns automat,
     * astfel încât receptoarele cu auto-reply să nu intre în buclă cu serverul nostru.
     */
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'Auto-Submitted' => 'auto-replied',
                'X-Auto-Response-Suppress' => 'All',
                'Precedence' => 'bulk',
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation',
            with: ['data' => $this->data],
        );
    }
}
