<?php

namespace App\Controllers;

use App\Services\PDFService;
use App\Services\QRService;
use App\Services\RequestService;

class MainContentController {

    public static function generatePdf()
    {
        // todo: verify user

        $data = json_decode(file_get_contents('php://input'), true);

        $pdfName = PDFService::generatePDF($data['content']);
        $imgName = QRService::generateQRCode();

        return RequestService::httpResponse(201, json_encode([
            'pdfPath' => "media/pdf/" . $pdfName,
            'imgPath' => "media/img/" . $imgName
        ]));
    }
}
