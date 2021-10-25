<?php

use App\Core\Controller;
use Dompdf\Dompdf;

class Pdf extends Controller
{
  public function index()
  {
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    //rederizando html externo
    ob_start();
    require 'teste.php';
    $dompdf->loadHtml(ob_get_clean());

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("doc", ["Attachment" => false]);
    $this->view('pdf/index');
  }
}
