<?php

namespace App\Listeners;

use App\Services\PdfGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Events\PdfGeneratedEvent;
use App\Events\ConfirmAppointmentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class GeneratePdfListener
{

    public function __construct(public PdfGenerator $pdfGenerator)
    {
        //
    }

    public function handle(ConfirmAppointmentEvent $event): void
    {
        $appointment = $event->appointment;
        $pdfContent = $this->pdfGenerator->generatePdf($appointment);

        $pdfPath = storage_path('app/pdfs/' . uniqid() . '_confirmation.pdf');
        file_put_contents($pdfPath, $pdfContent);

        event(new PdfGeneratedEvent($appointment, $pdfPath));
    }
}
