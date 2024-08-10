<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\App;

class ExportPdfController extends Controller
{

    public static function exportPDF($html)
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>islam</h1>');
        return $pdf->stream();
    }
}
