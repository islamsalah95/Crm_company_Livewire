<?php
namespace App\Traits;

use Illuminate\Support\Facades\App;


trait ExportPdfTrait 
{



    public static function exportPDF($html)
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }


}
