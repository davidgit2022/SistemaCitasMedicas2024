<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $appointment;
    public $pdfPath;

    public function __construct($data)
    {
        $this->appointment = $data['appointment'];
        $this->pdfPath = $data['pdfPath'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Confirmation',
            from: new Address(env('MAIL_FROM_ADDRESS', 'no-reply@myplataform.com'), env('MAIL_FROM_NAME'),'administracion')
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.email-appointment-confirmation',
        );
    }


    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath, [
                'as' => 'Confirmation.pdf',
                'mime' => 'application/pdf',
            ]),
        ];
    }
}
