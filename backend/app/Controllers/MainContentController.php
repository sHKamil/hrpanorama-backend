<?php

namespace App\Controllers;

use App\Services\PDFService;
use App\Services\QRService;
use App\Services\RequestService;

class MainContentController {

    public static function generatePdf($payload)
    {
        // todo: verify user

        $content = $payload->content;

        $pdfName = PDFService::generatePDF($content);
        $imgName = QRService::generateQRCode();

        return RequestService::httpResponse(201, json_encode([
            'pdfPath' => "media/pdf/" . $pdfName,
            'imgPath' => "media/img/" . $imgName
        ]));
    }
}
