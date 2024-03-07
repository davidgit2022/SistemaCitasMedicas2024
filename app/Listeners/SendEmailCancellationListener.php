<?php

namespace App\Listeners;

use App\Events\CancelAppointmentEvent;
use App\Mail\AppointmentCancelled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailCancellationListener
{

    public function __construct()
    {
        //
    }


    public function handle(CancelAppointmentEvent $event): void
    {
        $appointment = $event->appointment;
        $email = $event->appointment->patient->email;
        Mail::to($email)->send(new AppointmentCancelled($appointment));
    }
}
