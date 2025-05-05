<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf(ClientResponse $clientResponse)
    {
        $pdf = PDF::loadView('pdf.technical-specification', compact('clientResponse'));
        
        return $pdf->download('fiche-technique-' . $clientResponse->id . '.pdf');
    }
}
