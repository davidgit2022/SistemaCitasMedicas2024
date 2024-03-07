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

class AppointmentCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $rol;

    public function __construct(public Appointment $appointment)
    {
        $this->user = Auth::user();
        $this->rol = $this->user->getRoleNames()->first();
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Cancelled',
            from: new Address(env('MAIL_FROM_ADDRESS', 'no-reply@myplataform.com'), env('MAIL_FROM_NAME'),'administracion')
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.email-appointment-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
