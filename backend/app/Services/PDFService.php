<?php

namespace App\Services;

use Dompdf\Dompdf;

class PDFService {
    
    public static function generatePDF(String $content)
    {
        $dompdf = new Dompdf();

        $html = '<html><body>' . $content . '</body></html>';
        $dompdf->loadHtml($html);
        $pdfName = uniqid() . '.pdf';
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents("media/pdf/" . $pdfName, $output);

        return $pdfName;
    }
}