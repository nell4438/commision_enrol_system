<?php
$con = mysqli_connect("localhost", "root", "","cvsu_arec");

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
// function Footer()
// {
// 	// Position at 1.5 cm from bottom
// 	$this->SetY(-25);
// 	// Arial italic 8
// 	$this->SetFont('Arial','I',8);
// 	// Page number
// 	$this->Cell(0,5,"3rd Floor, Room 1. No. 3B jasmin Street. Roxas District,1103",0,1,'C');

// 	$this->Cell(0,5,"Tel. No. 414-7547 Telefax No: 441-4726, 045-6850833",0,1,'C');
// 	$this->Cell(0,5,"3Mobile No. 0918-8672767",0,1,'C');
// 	$this->Cell(0,10,$this->PageNo()."'/{nb}'",0,0,'R');

// }
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
    // Logo


    	$this->Image('../images/cvsu_arec.png',10,16,15);
		$this->SetFont('Times','',16);
		$this->Cell(80);
		$this->Cell(30,10,'CvSU AREC',0,1,'C');
		$this->Cell(80);
		$this->Line(15, 45, 200, 45);
		$this->Cell(30,10,'LIST OF ACCOUNT',0,1,'C');
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
		
		// $this->Line(0, 45, 600, 45);
		$this->Cell(15,-15,'ID',0,0,'C');
		$this->Cell(25,-15,'LEVEL',0,0,'C');
		$this->Cell(30,-15,'USER',0,0,'C');
		$this->Cell(35,-15,'STATUS',0,0,'C');
		$this->Cell(0,-15,'REGISTER',0,1,'C');
		$this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
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




if (isset($_REQUEST['report']) == "AccountList") {

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
 	$sql = mysqli_query($con,"SELECT * FROM `user_accounts` ua
INNER JOIN `user_level` `ul` ON `ua`.`level_ID` = `ul`.`level_ID`
INNER JOIN `user_status` `us` ON `ua`.`user_status` = `us`.`status_ID`
");

    while ($student_data = mysqli_fetch_array($sql)) 
    {

	
    
	$pdf->CellFitSpace(15,5,$student_data[0],1,0,'C');
	$pdf->Cell(20,5,$student_data['level_name'],1,0,'C');
	$pdf->CellFitSpace(30,5,$student_data['user_Name'],1,0,'C');
	$pdf->CellFitSpace(35,5,$student_data['status_Name'],1,0,'C');
	$pdf->Cell(0,5,$student_data['user_Registered'],1,1,'C');
    }
}


	$pdf->Output();

?>
