<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf {
    public function create($html, $filename)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, array('Attachment' => 0));
    }
}