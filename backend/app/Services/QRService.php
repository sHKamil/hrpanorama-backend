<?php

namespace App\Services;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QRService {
    
    public static function generateQRCode($content = "https://hrpanorama.pl/", $size = 200, $format = 'png')
    {
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new ImagickImageBackEnd()
        );
        $filename = uniqid() . '.png';
        $writer = new Writer($renderer);
        $writer->writeFile($content, 'media/img/' . $filename);

        return $filename;
    }
}