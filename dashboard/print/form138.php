<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('../../assets/plugins/fpdi2.2.0/fpdf.php');
require_once('../../assets/plugins/fpdi2.2.0/autoload.php');
require_once('class.function.php');
$print = new PrntFunction();  	



$pdf = new FPDI();
// get the page count
$pageCount = $pdf->setSourceFile('../../assets/plugins/fpdi2.2.0/pdf_files/form138.pdf');
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    if ($size[0] > $size[1]) {
        $pdf->AddPage('L', array($size[0], $size[1]));
    } else {
        $pdf->AddPage('P', array($size[0], $size[1]));
    }

    // use the imported page
    $pdf->useTemplate($templateId);

    $pdf->SetFont('Arial','B',9);
	if ($pageNo == 1) {
	
		$pdf->SetFont('Times','I',9);
		$pdf->Cell(65);
		$pdf->Cell(0,-15,'',0,1);
		$pdf->Cell(165);
		$pdf->SetFont('Times','',9);
		$pdf->Cell(0,85,"sasdad",0,1);
		$pdf->Cell(170);
		$pdf->Cell(0,-73,"sasdad",0,1);
 		$pdf->Cell(230);
		$pdf->Cell(0,73,"sasdad",0,1);

		$pdf->Cell(170);
		$pdf->Cell(0,-58,"sasdad",0,1);
 		$pdf->Cell(230);
		$pdf->Cell(0,58,"sasdad",0,1);

		$pdf->Cell(195);
		$pdf->Cell(0,-43,"sasdad",0,1);
	 }//if ($pageNo == 1) 

}//for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 

$pdf->Output();