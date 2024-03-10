<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Appointment;


class PdfGenerator
{
    public function generatePdf(Appointment $appointment): string
    {
        $pdfContent = PDF::loadView('pdf.confirmation-appointment', ['appointment' => $appointment])->output();

        return $pdfContent;
    }
}
