<?php


require('fpdf.php');
	function numberToRomanRepresentation($number) {
	    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	    $returnValue = '';
	    while ($number > 0) {
	        foreach ($map as $roman => $int) {
	            if($number >= $int) {
	                $number -= $int;
	                $returnValue .= $roman;
	                break;
	            }
	        }
	    }
	    return $returnValue;
	}

/*******************************************************************************
* FPDF Plugin  by Olivier PLATHEY                                              *
*                                                                              *
* Version: 1.81                                                                *
* Date:    2019-01-28                                                          *
* Edit by:  Rhalp Darren R. Cabrera                                            *
* Mail:  rhalpdarrencabrera@gmail.com                        				   *
*******************************************************************************/
class PDF extends FPDF
{

	// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-25);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,5,"3rd Floor, Room 1. No. 3B jasmin Street. Roxas District,1103",0,1,'C');

	$this->Cell(0,5,"Tel. No. 414-7547 Telefax No: 441-4726, 045-6850833",0,1,'C');
	$this->Cell(0,5,"3Mobile No. 0918-8672767",0,1,'C');
	$this->Cell(0,10,$this->PageNo()."'/{nb}'",0,0,'R');

}
	/*******************************************************************************
	* HEADER STYLE                                             						*
	*******************************************************************************/
	//Cell with horizontal scaling if text is too wide
	//Patrick Benny script Fit text to cell
	function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
	{
		//Get string width
		$str_width=$this->GetStringWidth($txt);

		//Calculate ratio to fit cell
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$ratio = ($w-$this->cMargin*2)/$str_width;

		$fit = ($ratio < 1 || ($ratio > 1 && $force));
		if ($fit)
		{
			if ($scale)
			{
				//Calculate horizontal scaling
				$horiz_scale=$ratio*100.0;
				//Set horizontal scaling
				$this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
			}
			else
			{
				//Calculate character spacing in points
				$char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
				//Set character spacing
				$this->_out(sprintf('BT %.2F Tc ET',$char_space));
			}
			//Override user alignment (since text will fill up cell)
			$align='';
		}

		//Pass on to Cell method
		$this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

		//Reset character spacing/horizontal scaling
		if ($fit)
			$this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
	}

	//Cell with horizontal scaling only if necessary
	function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		$this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
	}

	//Cell with horizontal scaling always
	function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		$this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
	}

	//Cell with character spacing only if necessary
	function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		$this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
	}

	//Cell with character spacing always
	function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		//Same as calling CellFit directly
		$this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
	}

	//Patch to also work with CJK double-byte text
	function MBGetStringLength($s)
	{
		if($this->CurrentFont['type']=='Type0')
		{
			$len = 0;
			$nbbytes = strlen($s);
			for ($i = 0; $i < $nbbytes; $i++)
			{
				if (ord($s[$i])<128)
					$len++;
				else
				{
					$len++;
					$i++;
				}
			}
			return $len;
		}
		else
			return strlen($s);
	}

//Patrick Benny script Fit text to cell end
	
	function Header()
		{
		$this->Image('../img/logo1.png',10,16,80);
		$this->SetFont('Times','',8);
		$this->Cell(80);
		$this->Cell(30,10,'',0,1,'C');
		$this->Cell(80);
		$this->Cell(30,0,'',0,1,'C');
		$this->SetFont('Times','B',8);
		$this->Cell(80);
		$this->Cell(30,10,'',0,1,'C');
		$this->SetFont('Times','',8);
		$this->Cell(80);
		$this->Cell(30,0,'',0,1,'C');
		$this->Ln(20);
		$this->SetTextColor(0, 128, 0);
		// $this->Line(15, 45, 200, 45);
		$this->Line(0, 45, 600, 45);
		$this->Cell(40,-15,'GEN. CONTRACTOR',0,0,'C');
		$this->Cell(30,-15,'DESIGNER',0,0,'C');
		$this->Cell(30,-15,'CONSULTANT',0,0,'C');
		$this->Cell(30,-15,'FABRICATOR',0,1,'C');
		$this->Ln(5);

		$this->SetTextColor(0);
		
		if (isset($_POST['Print_Sp'])) {
			if (isset($_POST['date_start']) || isset($_POST['date_end'])) {
			$date_start = $_POST['date_start'];
			$date_end = $_POST['date_end'];
			// $type = $_POST['type'];
			$date_start = date("M,Y", strtotime($date_start));
			$date_end = date("M,Y", strtotime($date_end));
	    	}
			$this->Cell(0,30, "Start to: ".$date_start." End to: ".$date_end,0,0,'C');

		}
		else{
			if (isset($_POST['date'])) {
				$date = $_POST['date'];
				$type = $_POST['type'];
				if ($type == "year") {
		        	$date = date("Y", strtotime($date));


		        }
		        if ($type == "month") {
		        	$date = date("M,Y", strtotime($date));
		        }

				$this->Cell(0,30, "Date: ".$date,0,0,'C');
			}

		}
		// else{
		// 	if (isset($_POST['date'])) {
		// 	$date = $_POST['date'];
		// 	$type = isset($_POST['type']);
		// 	if ($type == "year" || $type == 1) {
		// 		$label  = "Year: ";
		// 		$date = date("Y", strtotime($date));
		// 	}
		// 	if ($type == "month" || $type == 2) {
		// 		$label  = "Month & Year: ";
		// 		$date = date("M , Y", strtotime($date));
		// 	}
		//     $this->Cell(0,30, $label.$date,0,0,'C');
		// 	}
		// }
	

			
		
		$this->Ln(20);
	if (isset($_POST['Print_All_Trans'])) {
		
		$this->SetFont('Times','B',16);
		$this->Cell(0,5,"All Transaction",0,1,'C');
		$this->SetFont('Times','B',8);
		$this->Cell(80,5,"PROJECT TITLE",0,0);
		$this->Cell(25,5,"AMOUNT",0,0);
		$this->CellFitSpace(60,5,"DOWNPAYMENT",0,0);
		$this->CellFitSpace(60,5,"PROGRESS BILLING",0,0);
		$this->CellFitSpace(60,5,"RETENTION",0,0);
		$this->Cell(25,5,"STATUS",0,1);
		$this->SetFont('Times','B',8);
	}
		if (isset($_POST['Print_inventory'])) {
		$this->SetFont('Times','B',16);
		$this->Cell(0,5,"Total Equipment",0,1,'C');
		$this->SetFont('Times','B',8);
		$this->Cell(50,10,"QTY",0,0);
		$this->Cell(50,10,"UNIT",0,0);
		$this->Cell(0,10,"DESCRIPTION",0,1,'L');
		}
		if (isset($_POST['Print_Sp'])) {
			$this->SetFont('Times','B',8);
		$this->Cell(100,5,"TITLE",0,0);
		// $line_height = 5;
		// $width = 80;
		// $text = ("TITLE");    
		// $height = (ceil(($this->GetStringWidth($text) / $width)) * $line_height);
		// $this->Multicell($width,$height,$text,0,0);
		$this->Cell(50,5,"PROJECT OWNER",0,0);
		$this->Cell(25,5,"LOCATION",0,0);
		$this->Cell(25,5,"COSTING",0,0);
		$this->Cell(25,5,"DATE STARTED",0,0);
		$this->Cell(25,5,"DATE END",0,0);
		$this->CellFitScaleForce(25,5,"PROJECT SCOPE",0,0);
		$this->CellFitScaleForce (25,5,"PROJECT HEAD",0,0);
		$this->CellFitScaleForce (25,5,"PROJECT EXPENSES",0,0);
		$this->Cell(25,5,"STATUS",0,1);
		$this->SetFont('Times','B',8);
		}
		if (isset($_POST['Print_usage_eq'])) {

		$this->SetFont('Times','B',16);
			$this->Cell(0,5,"Equipment Usage",0,1,'C');
		$this->SetFont('Times','B',8);
		$this->Ln(5);
		$this->Cell(100,5,"Project Name",0,0);
		$this->Cell(50,5,"Equipment Name",0,0);
		$this->Cell(25,5,"Quantity",0,1);
	    }

	    if (isset($_POST['Print_Trans'])) {
		$con = mysqli_connect("localhost", "root", "","cycon_inc");
		$proj_ID=$_REQUEST['proj_ID'];
		$z = mysqli_query($con,"SELECT * FROM `project_monitoring` WHERE proj_ID=$proj_ID");
		//numberToRomanRepresentation($a).".) "
		$this->SetFont('Times','B',16);
 $z = mysqli_fetch_array($z);
		$this->Cell(0,5,$z[1],0,1,'C');
		$this->SetFont('Times','',8);
		// $this->Ln(5);
		// $this->Cell(50,5,"ITEM NO.",0,0);
		// $this->Cell(50,5,"SUMMARY",0,0);
		// $this->Cell(50,5,"AMOUNT",0,1);

		
	
			}
	

		}

	}

// function Footer()
// {
//     // Go to 1.5 cm from bottom
//     $this->SetY(-15);
//     // Select Arial italic 8
//     $this->SetFont('Arial','I',8);
//     // Print centered page number
//     $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
// }


// Instanciation of inherited class
$pdf = new PDF();
$con = mysqli_connect("localhost", "root", "","cycon_inc");



if (isset($_POST['Print_All_Trans'])) {
	$pdf->AliasNbPages();
	$pdf->AddPage('L','Legal');
	$pdf->SetFont('Times','',8);
	

        $po = mysqli_query($con,"SELECT * FROM `project_monitoring` WHERE visibility = 1 ORDER BY `project_monitoring`.`date_added` DESC");

        while ($po_data = mysqli_fetch_array($po)) 
        {
 
        $po1 = mysqli_query($con,"SELECT pm.proj_Title,po.po_ORNum,po.po_Date,sum(bodq.boqdet_Amount) boqdet_Amount,s.status_Name,po.po_ID,pm.proj_ID,pm.proj_DateStarted,pm.proj_DateEnded,(SELECT SUM(pt_amount) FROM `purchase_transaction` WHERE term_ID =1  AND status_ID = 2 AND po_ID = po.po_ID) term_1_amount,(SELECT SUM(pt_amount) FROM `purchase_transaction` WHERE term_ID =2 AND status_ID = 2 AND po_ID = po.po_ID) term_2_amount,(SELECT SUM(pt_amount) FROM `purchase_transaction` WHERE term_ID =3 AND status_ID = 2 AND po_ID = po.po_ID) term_3_amount  FROM `purchase_order` po
INNER JOIN project_monitoring pm ON po.proj_ID = pm.proj_ID
INNER JOIN `status` s ON po.status_ID = s.status_ID

LEFT join boq_detail bodq ON bodq.proj_ID = pm.proj_ID WHERE pm.proj_ID =  $po_data[0]");
        $po_data1 = mysqli_fetch_array($po1);

              if($po_data1['status_Name']){
             	$status_w = "with balance";
              }

              else if($po_data1['status_Name']){
              	$status_w = "paid";
              }
              else {
              	$status_w = "boq process";
              }

	$pdf->CellFitSpace(80,5,$po_data1[0],0,0);
		$pdf->Cell(25,5,$po_data['proj_Costing'],0,0);
		$pdf->CellFitSpace(60,5,"".number_format($po_data1['term_1_amount'],2)."",0,0);
		$pdf->CellFitSpace(60,5,"".number_format($po_data1['term_2_amount'],2)."",0,0);
		$pdf->CellFitSpace(60,5,"".number_format($po_data1['term_3_amount'],2)."",0,0);
		$pdf->Cell(25,5,$status_w,0,1);
    }
	
}
if (isset($_POST['Print_inventory'])) {
	$pdf->AliasNbPages();
	$pdf->AddPage('P','Legal');
	$pdf->SetFont('Times','',8);
	
	$sql = mysqli_query($con,"
		SELECT eq.equip_Quantity,u.unit_Name,eq.equip_Name FROM `equipment` eq
		INNER JOIN unit u  on eq.unit_ID = u.unit_ID");

	while ($data = mysqli_fetch_array($sql)) {
	$pdf->Cell(50,3,number_format($data['equip_Quantity']),0,0);
	$pdf->Cell(50,3,$data['unit_Name'],0,0);
	$pdf->Cell(0,3,$data['equip_Name'],0,1,'L');
	}
}
if (isset($_POST['Print_Sp'])) {
	$pdf->AliasNbPages();
	$pdf->AddPage('L','Legal');
	$pdf->SetFont('Times','',8);
	if (isset($_POST['date_start']) || isset($_POST['date_end'])) {
		$date_start = $_POST['date_start'];
		$date_end = $_POST['date_end'];
		// $type = $_POST['type'];
		// if ($type == "year") {
  //       	$date_start = date("Y", strtotime($date_start))."-1-0";
  //       	$date_end = date("Y", strtotime($date_end))."-12-31";


  //       }
  //       if ($type == "month") {
        	
  //       }
        $date_start = $date_start."-0";
			$date_end = $date_end."-31";

	 $filter_date = " WHERE pm.proj_DateStarted >= '".$date_start."' AND  pm.proj_DateEnded <= '".$date_end."'";
	
	}
	else{
		$filter_date = "";
	}

    
	$sql = mysqli_query($con,"SELECT * FROM `project_monitoring` pm
INNER JOIN `status` s ON pm.status_ID = s.status_ID
		 $filter_date");

	while ($data = mysqli_fetch_array($sql)) {

            	$vis = "";
	if ($data['visibility']) {
             
              if( $data['visibility'] == 2){
              $vis =  " (Terminated)";
              }
              if( $data['visibility'] == 3){
              
              $vis =  " (On-hold)";
              }
            }
	$pdf->CellFitScale(100,5,$data['proj_Title'].$vis,0,0);
	$pdf->CellFitScale(50,5,$data['proj_Owner'],0,0);
	$pdf->CellFitScale(25,5,$data['proj_Location'],0,0);
	
	$pdf->Cell(25,5,number_format($data['proj_Costing'],2),0,0);
	$pdf->Cell(25,5,$data['proj_DateStarted'],0,0);
	$pdf->Cell(25,5,$data['proj_DateEnded'],0,0);
	$pdf->CellFitScale(25,5,$data['proj_Scope'],0,0);
	$pdf->Cell(25,5,$data['proj_Head'],0,0);
	$pdf->Cell(25,5,number_format($data['proj_Expenses'],2),0,0);
	$pdf->Cell(25,5,$data['status_Name'],0,1);
	}

}

if (isset($_POST['Print_usage_eq'])) {
	// "SELECT pm.proj_Title,eq.equip_Name,eu.usage_Quantity FROM `equipment_usage` eu
	// INNER JOIN project_monitoring pm ON eu.proj_ID = pm.proj_ID
	// INNER JOIN equipment eq ON eu.equip_ID = eq.equip_ID"
	$pdf->AliasNbPages();
	$pdf->AddPage('P','');
	$pdf->SetFont('Times','',8);
	if (isset($_POST['date'])) {

		$date = $_POST['date'];
		$type = $_POST['type'];
		if ($type == "year") {
        	$date = date("Y", strtotime($date));
        }
	$filter_date = " WHERE eu.date_added LIKE '%$date%'";
	}
	else{
		$filter_date = "";
	}
	$sql = mysqli_query($con,"SELECT pm.proj_Title,eq.equip_Name,eu.usage_Quantity FROM `equipment_usage` eu
	 INNER JOIN project_monitoring pm ON eu.proj_ID = pm.proj_ID
	INNER JOIN equipment eq ON eu.equip_ID = eq.equip_ID $filter_date");

	while ($data = mysqli_fetch_array($sql)) {
	$pdf->Cell(100,5,$data['proj_Title'],0,0);
	$pdf->Cell(50,5,$data['equip_Name'],0,0);
	$pdf->Cell(25,5,number_format($data['usage_Quantity']),0,1);
	}
}
if (isset($_POST['Print_Trans'])) {
	
	//numberToRomanRepresentation($a).".) "
	$proj_ID=$_REQUEST['proj_ID'];
	$pdf->AliasNbPages();
	$pdf->AddPage('P','');
	$pdf->SetFont('Times','',8);
	if (isset($_POST['date'])) {
		$date = $_POST['date'];
		$type = isset($_POST['type']);
		if ($type == "year") {
        	$date = date("Y", strtotime($date));
        }
	$filter_date = "  AND boqdet_Date LIKE '%$date%'";
	}
	else{
		$filter_date = "";
	}
	$z = mysqli_query($con,"SELECT * FROM `boq_detail` WHERE proj_ID=$proj_ID $filter_date");
	$z1 = mysqli_query($con,"SELECT * FROM `boq_detail` WHERE proj_ID=$proj_ID $filter_date");
	$a=1;
	
$pdf->SetFont('Times','',8);
	while ($zd = mysqli_fetch_array($z)) {
$b=1;
			$pdf->SetFont('Times','B',8);
			$pdf->Ln(5);
			$pdf->Cell(50,5,numberToRomanRepresentation($a).".",1,0);
			$pdf->Cell(0,5,"$zd[1]",1,1);
			$z2 = mysqli_query($con,"SELECT bol.material_Name,bol.material_Qty,u.unit_Name,bol.material_Price,(bol.material_Price*bol.material_Qty) as TotalAmount FROM `boq_material_list` bol
INNER JOIN unit u ON bol.unit_ID = u.unit_ID where  boqdet_ID = $zd[0]");
			$pdf->Cell(15,5,"ITEM NO.",1,0);
			$pdf->Cell(80,5,"DESCRIPTION",1,0);
			$pdf->Cell(25,5,"QTY",1,0);
			$pdf->Cell(25,5,"UNIT",1,0);
			$pdf->Cell(20,5,"UNIT PRICE",1,0);
			$pdf->Cell(0,5,"TOTAL AMOUNT",1,1);
			while ($zz1 = mysqli_fetch_array($z2)){
				$pdf->Cell(15,5,$b,1,0);
				$pdf->CellFitSpace(80,5,$zz1[0],1,0);
				$pdf->Cell(25,5,number_format($zz1[1],2),1,0);
				$pdf->Cell(25,5,$zz1[2],1,0);
				$pdf->Cell(20,5,number_format($zz1[3],2),1,0);
				$pdf->Cell(0,5,number_format($zz1[4],2),1,1);
				$b++;
			}
			$pdf->Cell(95,5,"",1,0);
			$pdf->Cell(0,5,"TOTAL AMOUNT: ".number_format($zd[2],2),1,1);
			$pdf->Ln(5);

		$a++;
		
	}

			$pdf->SetFont('Times','B',8);
			$pdf->Ln(5);
			$pdf->Cell(50,5,"ITEM NO.",1,0);
			$pdf->Cell(100,5,"SUMMARY",1,0);
			$pdf->Cell(0,5,"AMOUNT",1,1);
		$a=1;
		$sum=0;
	while ($zd = mysqli_fetch_array($z1)) {

		$pdf->Cell(50,5,numberToRomanRepresentation($a).".",1,0);
		$pdf->CellFitSpace(100,5,$zd[1],1,0);
		$pdf->Cell(0,5,number_format($zd[2],2),1,1);
		$a++;
		$sum+=$zd[2];
	}
	$pdf->Cell(95,5,"",1,0);
			$pdf->Cell(0,5,"GRAND TOTAL AMOUNT: ".number_format($sum,2),1,1);

}

function material(){

	// $z = mysqli_query($con,"SELECT * FROM `boq_material_list` WHERE boqdet_ID = $zd[0]");
	// 	while ($zz = mysqli_fetch_array($z)){

			$pdf->Cell(50,5,$zd[0],1,0);
			// $pdf->Cell(100,5,"d",1,0);
			// $pdf->Cell(0,5,"c",1,1);
	// 	}
}

	$pdf->Output();

?>
