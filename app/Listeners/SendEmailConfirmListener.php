<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\ConfirmAppointmentEvent;
use App\Mail\AppointmentConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PdfGeneratedEvent;

class SendEmailConfirmListener
{

    public function __construct()
    {
        //
    }

    public function handle(PdfGeneratedEvent $event)
    {
        $appointment = $event->appointment;
        $pdfPath = $event->pdfPath;

        // Enviar correo electrónico con el PDF adjunto
        $emailData = [
            'appointment' => $appointment,
            'pdfPath' => $pdfPath,
        ];

        Mail::to($appointment->patient->email)
            ->send(new AppointmentConfirmation($emailData));
    }
}
