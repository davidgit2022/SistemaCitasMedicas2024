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

        // Guardar el PDF en una ubicación específica
        $pdfPath = storage_path('app/pdfs/' . $appointment->id . '_confirmation.pdf');
        file_put_contents($pdfPath, $pdfContent);

        // Disparar otro evento para informar sobre la generación del PDF
        event(new PdfGeneratedEvent($appointment, $pdfPath));
    }
}
