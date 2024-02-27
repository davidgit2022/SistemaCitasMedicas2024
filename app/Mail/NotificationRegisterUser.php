<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class NotificationRegisterUser extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(public User $user)
    {

    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Register User',
            from: new Address(env('MAIL_FROM_ADDRESS', 'no-reply@myplataform.com'),env('MAIL_FROM_NAME'),'administracion')
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.email-register',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
