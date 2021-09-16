<?php
require __DIR__.'/../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
if(isset($_POST['generar_pdf'])){
    
    ob_start();
    require_once'productos_reporte.php';
    $html = ob_get_clean();


    $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
    $html2pdf -> writeHTML($html);
    $html2pdf -> output('pdf_generado.pdf');
}
?>
<form action="" method="POST">
    <input type="submit" name="generar_pdf2" value="crear" />
</form>