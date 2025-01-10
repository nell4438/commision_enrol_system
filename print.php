<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('assets/plugins/fpdi2.2.0/fpdf.php');
require_once('assets/plugins/fpdi2.2.0/autoload.php');
require_once('class.user.php');
$print = new USER();  	


function cf_check($cf_a,$cf_b){
	if ($cf_a === $cf_b){
		$cf_e =  "/";
	}
	else{
		$cf_e = "";
	}
	return $cf_e ;

}
function gl_check($gl_ID){
	if ($gl_ID == 1){
		$gl = "7";
	}
	if ($gl_ID == 2){
		$gl = "8";
	}
	if ($gl_ID == 3){
		$gl = "9";
	}
	if ($gl_ID == 4){
		$gl = "10";
	}
	if ($gl_ID == 5){
		$gl = "11";
	}
	if ($gl_ID == 6){
		$gl = "12";
	}
	return $gl;
}
$pdf = new FPDI();

if (isset($_REQUEST["action"])) 
{
	if ($_REQUEST["action"] == "print_admission") 
	{
		$pageCount = $pdf->setSourceFile('assets/plugins/fpdi2.2.0/pdf_files/enrolmentform.pdf');

		// get the page count
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size[0] > $size[1]) {
		        $pdf->AddPage('L', array($size[0], $size[1]));
		    } 
		    else {
		        $pdf->AddPage('P', array($size[0], $size[1]));
		    }

		    // use the imported page
		    $pdf->useTemplate($templateId);

		    $pdf->SetFont('Arial','B',9);
			if ($pageNo == 1) {

				$adm_classification 		= addslashes(ucwords($_REQUEST["adm_classification"]));
				$adm_lrn 					= addslashes(ucwords($_REQUEST["adm_lrn"]));
				$adm_gradelevel 			= addslashes(ucwords($_REQUEST["adm_gradelevel"]));
				$adm_fname 					= addslashes(ucwords($_REQUEST["adm_fname"]));
				$adm_mname 					= addslashes(ucwords($_REQUEST["adm_mname"]));
				$adm_lname 					= addslashes(ucwords($_REQUEST["adm_lname"]));
				$adm_suffix 				= addslashes(ucwords($_REQUEST["adm_suffix"]));
				$adm_email 					= addslashes($_REQUEST["adm_email"]);
				$adm_bod 					= addslashes(ucwords($_REQUEST["adm_bod"]));
				$adm_bod_age 				= $_REQUEST["adm_bod_age"];
				$adm_sex 					= addslashes(ucwords($_REQUEST["adm_sex"]));
				$adm_address 				= addslashes(ucwords($_REQUEST["adm_address"]));
				$adm_house 					= addslashes(ucwords($_REQUEST["adm_house"]));
				$adm_pg_name 				= addslashes(ucwords($_REQUEST["adm_pg_name"]));
				$adm_pg_contact 			= addslashes(ucwords($_REQUEST["adm_pg_contact"]));
				$adm_pg_alt_contact 		= addslashes(ucwords($_REQUEST["adm_pg_alt_contact"]));
				$adm_parentjob 				= addslashes(ucwords($_REQUEST["adm_parentjob"]));
				$adm_studliving 			= addslashes(ucwords($_REQUEST["adm_studliving"]));
				$adm_height 				= addslashes(ucwords($_REQUEST["adm_height"]));
				$adm_weight 				= addslashes(ucwords($_REQUEST["adm_weight"]));
				$adm_bmis 					= addslashes(ucwords($_REQUEST["adm_bmis"]));
				$adm_bmistat 				= addslashes(ucwords($_REQUEST["adm_bmistat"]));
				$adm_FeedProg 				= addslashes(ucwords($_REQUEST["adm_FeedProg"]));
				$adm_InDeworming 			= addslashes(ucwords($_REQUEST["adm_InDeworming"]));
				$enrolee_medDecease1 		= addslashes(ucwords($_REQUEST["enrolee_medDecease1"]));
				$enrolee_medDecease2 		= addslashes(ucwords($_REQUEST["enrolee_medDecease2"]));
				$enrolee_medDecease3 		= addslashes(ucwords($_REQUEST["enrolee_medDecease3"]));
				$enrolee_medDecease4 		= addslashes(ucwords($_REQUEST["enrolee_medDecease4"]));
				$enrolee_medDeceaseDate1 	= addslashes(ucwords($_REQUEST["enrolee_medDeceaseDate1"]));
				$enrolee_medDeceaseDate2 	= addslashes(ucwords($_REQUEST["enrolee_medDeceaseDate2"]));
				$enrolee_medDeceaseDate3 	= addslashes(ucwords($_REQUEST["enrolee_medDeceaseDate3"]));
				$enrolee_medDeceaseDate4 	= addslashes(ucwords($_REQUEST["enrolee_medDeceaseDate4"]));

				$suffix = $print->get_suffix($adm_suffix);

				if($adm_mname ==" " || $adm_mname == NULL || empty($adm_mname) )
				{
					$mname = " ";
				}
				else
				{
					$mname = wordwrap($adm_mname,0).'. ';
				}
				$full_name = ucwords(strtolower($adm_fname.' '.$mname.$adm_lname.' '.$suffix));
				$gas =	$print->get_active_sem();
				foreach($gas as $row)
				{
					$semyear = $row["sem_year"];
				}

			
	          
	            $today = date("Y/m/d");
				$birthDate = $adm_bod;

				$today = date_create($today);
				$birthDate = date_create($birthDate);

				$df_timenow_y = date_format($today,"Y");
				$df_bday_y = date_format($birthDate,"Y");

	            $age = $df_timenow_y - $df_bday_y;
	            $adm_bod_age = $age;
	            


				//A. Registration Info.
				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,69,'',0,1);
				$pdf->Cell(30);
				$pdf->Cell(116,10,$full_name,0,0);
				$pdf->Cell(35,10,$adm_lrn,0,1);
				$pdf->Cell(30);
				$pdf->Cell(0,10,$adm_address,0,1);
				$pdf->Cell(45);
				$pdf->Cell(40,4,gl_check($adm_gradelevel),0,0);
				$pdf->Cell(45,4,$adm_bod,0,0);
				$pdf->Cell(25,4,$adm_bod_age,0,0);
				$pdf->Cell(0,4,$print->get_sex($adm_sex),0,1);
				$pdf->Cell(30);
				$pdf->Cell(116,10,$adm_email,0,1);
				$pdf->Cell(50);
				$pdf->Cell(50,4,cf_check("2",$adm_classification),0,0);
				$pdf->Cell(45,4,cf_check("1",$adm_classification),0,0);
				$pdf->Cell(0,4,cf_check("3",$adm_classification),0,1);
				$pdf->Cell(40);
				$pdf->Cell(0,9,$semyear,0,1);
				//B. Other Data.
				$pdf->Cell(80,22,'',0,1);
				$pdf->Cell(60);
				$pdf->Cell(116,10,ucwords(strtolower($adm_pg_name)),0,1);
				$pdf->Cell(70);
				$pdf->Cell(80,0,$adm_pg_contact,0,0);
				$pdf->Cell(0,0,$adm_pg_alt_contact,0,1);
				$pdf->Cell(90);
				$pdf->Cell(0,10,$adm_parentjob,0,1);
				$pdf->Cell(30);
				$pdf->Cell(120,0,$adm_house,0,0);
				$pdf->Cell(0,0,$adm_studliving,0,1);
				//C. Biometric Data (Clinic / Nurse)
				$pdf->Cell(80,30,'',0,1);
				$pdf->Cell(40);
				$pdf->Cell(50,10,$adm_height,0,0);
				$pdf->Cell(45,10,$adm_weight,0,0);
				$pdf->Cell(0,10,$adm_bmis,0,1);
				$pdf->Cell(95);
				$pdf->Cell(0,4,$adm_FeedProg,0,1);
				$pdf->Cell(110);
				$pdf->Cell(0,10,$adm_InDeworming,0,1);
				$pdf->Cell(25);
				$pdf->Cell(85,20,$enrolee_medDecease1,0,0);
				$pdf->Cell(0,20,$enrolee_medDeceaseDate1,0,1);
				$pdf->Cell(25);
				$pdf->Cell(85,-10,$enrolee_medDecease2,0,0);
				$pdf->Cell(0,-10,$enrolee_medDeceaseDate2,0,1);
				$pdf->Cell(25);
				$pdf->Cell(85,20,$enrolee_medDecease3,0,0);
				$pdf->Cell(0,20,$enrolee_medDeceaseDate3,0,1);
				$pdf->Cell(25);
				$pdf->Cell(85,-10,$enrolee_medDecease4,0,0);
				$pdf->Cell(0,-10,$enrolee_medDeceaseDate4,0,1);
				$pdf->SetFont('Times','I',9);
				//DATE PRINT
				$pdf->Cell(160);
				$pdf->Cell(85,-480,"Print:(".date("Y/m/d h:i:sa").")",0,0);

				
				
				// admission_medDecease[0]
				// admission_medDeceaseDate[0]
			 }//if ($pageNo == 1) 

		}//for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 

	}//if ($_REQUEST["action"] == "print_admission") 
}//if (isset($_REQUEST["action"])) 


$pdf->Output();