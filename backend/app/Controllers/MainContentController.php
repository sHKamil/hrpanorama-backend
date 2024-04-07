<?php

namespace App\Controllers;

use App\Services\RequestService;
use Dompdf\Dompdf;

class MainContentController {

    public static function generatePdf($payload)
    {
        // todo: verify user

        $content = $payload->content;
        $dompdf = new Dompdf();

        $html = '<html><body>' . $content . '</body></html>';
        $dompdf->loadHtml($html);
        $filename = uniqid() . '.pdf';
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents("media/pdf/" . $filename, $output);

        return json_encode([
            'status' => '200',
            'pdfPath' => "media/pdf/" . $filename
        ]);
    }
}
