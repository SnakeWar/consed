<?php

namespace App\Utils;

use tecnickcom\tcpdf\TCPDF;
use setasign\Fpdi\Tcpdf\Fpdi;

class PdfSigner {

    public function __construct(){

    }

    public static function sign($file_path) {
        $pdf = new Fpdi();
        $certificate = 'file://'.base_path('cert.pem');
        $pkey = 'file://'.base_path('pkey.key');
        $pageCount = $pdf->setSourceFile($file_path);
        
        for($i = 1; $i <= $pageCount; $i++) {
            $tplIdx = $pdf->importPage($i, '/MediaBox');
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx);
        }
        $info = [];
        $pdf->setSignature($certificate, $pkey, 'tcpdfdemo', '', 2, $info);

        $result = $pdf->OutPut($file_path, 'F');
        // $result = $pdf->OutPut($file->file.'-signed.pdf', 'I');
        return $result;
    }
}