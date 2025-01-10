<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('../assets/plugins/fpdi2.2.0/fpdf.php');
require_once('../assets/plugins/fpdi2.2.0/autoload.php');
require_once('../class.user.php');
$print = new USER();  	

$pdf = new FPDI();


if (isset($_REQUEST["action"])) 
{
	if ($_REQUEST["action"] == "print_studentlist") 
	{
	
		$pageCount = $pdf->setSourceFile('../assets/plugins/fpdi2.2.0/pdf_files/print_studentlist.pdf');

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
			// if ($pageNo == 1) {
				$sql = "SELECT 
				rm.room_ID,
				rid.rid_FName,
				rid.rid_MName,
				rid.rid_LName,
				rsn.suffix,
				sec.section_Name ,
				rid.rid_ID,
				sec.section_ID,
				sem.sem_ID,

				CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear ,
				stat.status_Name

				FROM `room` `rm`
				LEFT JOIN `ref_section` `sec` ON `sec`.`section_ID` = `rm`.`section_ID`
				LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `rm`.`rid_ID`
				LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rid`.`suffix_ID`
				LEFT JOIN `ref_semester` `sem` ON sem.sem_ID = `rm`.`sem_ID`
				LEFT JOIN `ref_status` `stat` ON `stat`.`status_ID` = `rm`.`status_ID`

				WHERE rm.room_ID = '".$_REQUEST["room_ID"]."' 
				LIMIT 1"; 
				$stmt = $print->runQuery($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach($result as $row)
				{

				
					if($row["suffix"] =="N/A")
					{
						$suffix = "";
					}
					else
					{
						$suffix = $row["suffix"];
					}
					$output["room_ID"] = $row["room_ID"];
					$output["semyear"] = $row["semyear"];
					$output["room_adviser"] =  $row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix;

					$output["section_Name"] = $row["section_Name"];



				
				}
				$room_adviser 		= addslashes(ucwords($output["room_adviser"]));
				$section_Name 		= addslashes(ucwords($output["section_Name"]));
				

				// room_ID
				// rsub_ID


				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,60,'',0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,10,$room_adviser,0,0);
				$pdf->Cell(116,10,$output["semyear"],0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,0,$section_Name,0,1);
				$pdf->Cell(116,12,"",0,1);
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(15);
				$pdf->Cell(10,5,"#",1,0,"C");
				$pdf->Cell(22,5,"LRN",1,0);
				$pdf->Cell(133,5,"NAME",1,1);
				$pdf->SetFont('Times','',10);
				

				 if (isset($_REQUEST["handle_sec"])){
				 	$sql1 = "SELECT 
					`res`.`rse_ID`,
					`res`.`res_ID`,
					`rsd`.`rsd_ID`,
					`rsd`.`rsd_Img`,
					`rsd`.`rsd_StudNum`,
					`rsd`.`rsd_FName`,
					`rsd`.`rsd_MName`,
					`rsd`.`rsd_LName`,
					`sx`.`sex_Name`,
					`sn`.`suffix`
					FROM `room_enrolled_student`  res
					LEFT JOIN `record_student_enrolled` rse ON rse.rse_ID = res.rse_ID
					LEFT JOIN record_student_details rsd ON rsd.rsd_ID = rse.rsd_ID
					LEFT JOIN ref_suffixname sn ON sn.suffix_ID = rsd.suffix_ID
					LEFT JOIN ref_sex sx ON sx.sex_ID = rsd.sex_ID
					WHERE res.room_ID = '".$_REQUEST["room_ID"]."'
					";
				 }
				 else{
				 	$sql1 = "SELECT 
					res.res_ID,
					rsd.rsd_ID,
					rsd.user_ID,
					rsd.rsd_StudNum,
					rsd.rsd_Fname,
					rsd.rsd_MName,
					rsd.rsd_Lname,
					sf.suffix FROM `room_enrolled_student` `res`
					LEFT JOIN `room` `rm` ON `rm`.`room_ID` = `res`.`room_ID`
					LEFT JOIN `record_student_enrolled` `rse` ON `rse`.`rse_ID` = `res`.`rse_ID`
					LEFT JOIN `record_student_details` `rsd` ON `rsd`.`rsd_ID` = `rse`.`rsd_ID`
					LEFT JOIN `ref_suffixname` `sf` ON `sf`.`suffix_ID` = `rsd`.`suffix_ID`
					 WHERE `res`.`room_ID` = '".$_REQUEST["room_ID"]."' ";
				 }

				$stmt1 = $print->runQuery($sql1);
				$stmt1->execute();
				$result1 = $stmt1->fetchAll();
				$xi = 1;
				if($stmt1->rowCount() > 0 ){
						foreach($result1 as $row)
					{
						

						
							if($row["suffix"] =="N/A")
							{
								$suffix = "";
							}
							else
							{
								$suffix = $row["suffix"];
							}
							$sub_array = array();
							if (isset($_REQUEST["handle_sec"])){
								$studname = ucwords(strtolower($row["rsd_FName"].' '.$row["rsd_MName"].'. '.$row["rsd_LName"].' '.$suffix));
							}
							else{
								$studname = ucwords(strtolower($row["rsd_Fname"].' '.$row["rsd_MName"].'. '.$row["rsd_Lname"].' '.$suffix));
							}
							
							
							

							$rsd_StudNum = $row["rsd_StudNum"];
							$pdf->Cell(15);
							$pdf->Cell(10,5,$xi ,1,0,"C");
							$pdf->Cell(22,5,$rsd_StudNum,1,0);
							$pdf->Cell(133,5,$studname,1,1);
							$xi++;
					}
				}
				else{

				}
			




				//DATE PRINT
				// $pdf->Cell(0);
				// $pdf->Cell(85,0,"Print:(".date("Y/m/d h:i:sa").")",0,0);

				
				
			 // }//if ($pageNo == 1) 

		}//for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 

	}//if ($_REQUEST["action"] == "print_studentlist") 

	if ($_REQUEST["action"] == "print_subjectlist") 
	{

		$pageCount = $pdf->setSourceFile('../assets/plugins/fpdi2.2.0/pdf_files/print_subjectlist.pdf');

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
			// if ($pageNo == 1) {
				$sql = "SELECT 
				rm.room_ID,
				rid.rid_FName,
				rid.rid_MName,
				rid.rid_LName,
				rsn.suffix,
				sec.section_Name ,
				rid.rid_ID,
				sec.section_ID,
				sem.sem_ID,

				CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear ,
				stat.status_Name,
				ryl.yl_Name

				FROM `room` `rm`
				LEFT JOIN `ref_section` `sec` ON `sec`.`section_ID` = `rm`.`section_ID`
				LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `rm`.`rid_ID`
				LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rid`.`suffix_ID`
				LEFT JOIN `ref_semester` `sem` ON sem.sem_ID = `rm`.`sem_ID`
				LEFT JOIN `ref_status` `stat` ON `stat`.`status_ID` = `rm`.`status_ID`
				LEFT JOIN `ref_year_level` `ryl` ON `ryl`.`yl_ID` = `rm`.`yl_ID`

				WHERE rm.room_ID = '".$_REQUEST["room_ID"]."' 
				LIMIT 1"; 
				$stmt = $print->runQuery($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach($result as $row)
				{

				
					if($row["suffix"] =="N/A")
					{
						$suffix = "";
					}
					else
					{
						$suffix = $row["suffix"];
					}
					$output["room_ID"] = $row["room_ID"];
					$output["semyear"] = $row["semyear"];
					$output["room_adviser"] =  $row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix;

					$output["section_Name"] = $row["section_Name"];
					$output["yl_Name"] = $row["yl_Name"];



				
				}
				$room_adviser 		= addslashes(ucwords($output["room_adviser"]));
				$section_Name 		= addslashes(ucwords($output["section_Name"]));
				$yl_Namex 		= addslashes(ucwords($output["yl_Name"]));

				
				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,60,'',0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,10,$room_adviser,0,0);
				$pdf->Cell(116,10,$output["semyear"],0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,0,$section_Name,0,0);
				$pdf->Cell(116,0,$yl_Namex,0,1);
				$pdf->Cell(116,12,"",0,1);
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(15);
				$pdf->Cell(10,5,"#",1,0,"C");
				$pdf->Cell(88.5,5,"SUBJECT",1,0);
				$pdf->Cell(66.5,5,"TEACHER",1,1);
				$pdf->SetFont('Times','',10);

				$sql1 = "SELECT 
				* 
				 FROM `room_subject` rsub 
				LEFT JOIN `academic_staff` acs ON acs.acs_ID = rsub.acs_ID
				LEFT JOIN `ref_subject` `sub` ON `sub`.subject_ID = `acs`.subject_ID
				LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `acs`.`rid_ID`
				LEFT JOIN `ref_position` `pos` ON `pos`.`pos_ID` = `acs`.`pos_ID`
				LEFT JOIN `ref_suffixname` `sf` ON `sf`.`suffix_ID` = `rid`.`suffix_ID`

				  WHERE rsub.room_ID = '".$_REQUEST["room_ID"]."' ";
				 $stmt1 = $print->runQuery($sql1);
				$stmt1->execute();
				$result1 = $stmt1->fetchAll();
				$xi = 1;
				foreach($result1 as $row)
				{

					
						if($row["suffix"] =="N/A")
						{
							$suffix = "";
						}
						else
						{
							$suffix = $row["suffix"];
						}
						$sub_array = array();
					
						
						$subject_Code = $row["subject_Code"];
						$subject_Title= ucwords(strtolower($row["subject_Title"]));
						$subject_Teacher = ucwords(strtolower($row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix));

						$pdf->Cell(15);
						$pdf->Cell(10,5,$xi ,1,0,"C");
						// $pdf->Cell(22,5,$subject_Code,1,0);

						$pdf->Cell(88.5,5,$subject_Title,1,0);
						$pdf->Cell(66.5,5,$subject_Teacher,1,1);
						$xi++;
				}

				
				


				//DATE PRINT
				// $pdf->Cell(0);
				// $pdf->Cell(85,0,"Print:(".date("Y/m/d h:i:sa").")",0,0);

				
				
			 // }//if ($pageNo == 1) 

		}//for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 

	}//if ($_REQUEST["action"] == "print_subjectlist") 
	if ($_REQUEST["action"] == "print_subjectlist1") 
	{

		$pageCount = $pdf->setSourceFile('../assets/plugins/fpdi2.2.0/pdf_files/print_subjectlist.pdf');

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
			// if ($pageNo == 1) {
				$sql = "SELECT 
				rm.room_ID,
				rid.rid_FName,
				rid.rid_MName,
				rid.rid_LName,
				rsn.suffix,
				sec.section_Name ,
				rid.rid_ID,
				sec.section_ID,
				sem.sem_ID,

				CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear ,
				stat.status_Name,
				ryl.yl_Name

				FROM `room` `rm`
				LEFT JOIN `ref_section` `sec` ON `sec`.`section_ID` = `rm`.`section_ID`
				LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `rm`.`rid_ID`
				LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rid`.`suffix_ID`
				LEFT JOIN `ref_semester` `sem` ON sem.sem_ID = `rm`.`sem_ID`
				LEFT JOIN `ref_status` `stat` ON `stat`.`status_ID` = `rm`.`status_ID`
				LEFT JOIN `ref_year_level` `ryl` ON `ryl`.`yl_ID` = `rm`.`yl_ID`

				WHERE rm.room_ID = '".$_REQUEST["room_ID"]."' 
				LIMIT 1"; 
				$stmt = $print->runQuery($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach($result as $row)
				{

				
					if($row["suffix"] =="N/A")
					{
						$suffix = "";
					}
					else
					{
						$suffix = $row["suffix"];
					}
					$output["room_ID"] = $row["room_ID"];
					$output["semyear"] = $row["semyear"];
					$output["room_adviser"] =  $row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix;

					$output["section_Name"] = $row["section_Name"];
					$output["yl_Name"] = $row["yl_Name"];



				
				}
				$room_adviser 		= addslashes(ucwords($output["room_adviser"]));
				$section_Name 		= addslashes(ucwords($output["section_Name"]));
				$yl_Namex 		= addslashes(ucwords($output["yl_Name"]));

				
				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,60,'',0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,10,$room_adviser,0,0);
				$pdf->Cell(116,10,$output["semyear"],0,1);
				$pdf->Cell(40);
				$pdf->Cell(116,0,$section_Name,0,0);
				$pdf->Cell(116,0,$yl_Namex,0,1);
				$pdf->Cell(116,12,"",0,1);
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(15);
				$pdf->Cell(10,5,"#",1,0,"C");
				// $pdf->Cell(88.5,5,"SUBJECT",1,0);
				// $pdf->Cell(66.5,5,"TEACHER",1,1);
				$pdf->Cell(155,5,"SUBJECT",1,1);
				$pdf->SetFont('Times','',10);
				$sxz = array();
				$sxzx = array();
			
				


				$sql1 = "SELECT * 
				  FROM `gradelevel_subject` `gsub`
				  LEFT JOIN `ref_subject` `rsub` ON `rsub`.`subject_ID` = `gsub`.`subject_ID`

				WHERE sem_ID = '".$_REQUEST["sem_ID"]."' AND yl_ID = '".$_REQUEST["yl_ID"]."' ";
				 $stmt1 = $print->runQuery($sql1);
				$stmt1->execute();
				$result1 = $stmt1->fetchAll();
				$xi = 1;
				$xii =0;
				foreach($result1 as $row)
				{

					
						
						$sub_array = array();
					
						
						$subject_Code = $row["subject_Code"];
						$subject_Title= ucwords(strtolower($row["subject_Title"]));
						$subject_Teacher = $row["subject_ID"];

						$pdf->Cell(15);
						$pdf->Cell(10,5,$xi ,1,0,"C");
				
						// $pdf->Cell(88.5,5,$subject_Title,1,0);
						// $pdf->Cell(66.5,5,$print->get_teacher_p($_REQUEST["room_ID"],$subject_Teacher),1,1);

						$pdf->Cell(155,5,$subject_Title,1,1);
					
						
						$xi++;
						$xii++;
				}

				
				


				//DATE PRINT
				// $pdf->Cell(0);
				// $pdf->Cell(85,0,"Print:(".date("Y/m/d h:i:sa").")",0,0);

				
				
			 // }//if ($pageNo == 1) 

		}//for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 

	}//if ($_REQUEST["action"] == "print_subjectlist1") 
}//if (isset($_REQUEST["action"])) 




$pdf->Output();