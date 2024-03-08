<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Appointment;


class PdfGenerator
{
    public function generatePdf(Appointment $appointment): string
    {
        // Lógica para generar el contenido del PDF a partir de la cita médica
        $pdfContent = PDF::loadView('pdf.confirmation-appointment', ['appointment' => $appointment])->output();

        return $pdfContent;
    }
}
