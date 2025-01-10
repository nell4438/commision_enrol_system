<?php 
include('../session.php');


require_once("../class.user.php");

  
$timeZone = 'Asia/Manila';
date_default_timezone_set( $timeZone);
$dnow = date("Y/m/d", time());
$teacher_attnd = new USER();

$room_ID = $_POST["room_ID"];





if(isset($_POST["operation"]))
{

$output = array();
	if($_POST["operation"] == "fetch_modal_content")
	{	
		$room_ID = $_POST["room_ID"];
		
		$dnow =  $_POST["selectedDate"];
		// $date = $_POST["date"];
		


			$query ="";
			$query .= "
			SELECT 
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
			";
			$query .= " FROM `room_enrolled_student` res
			LEFT JOIN record_student_enrolled rse ON rse.rse_ID = res.rse_ID
			LEFT JOIN record_student_details rsd ON rsd.rsd_ID = rse.rsd_ID
			LEFT JOIN ref_suffixname sn ON sn.suffix_ID = rsd.suffix_ID
			LEFT JOIN ref_sex sx ON sx.sex_ID = rsd.sex_ID";




			if (isset($_POST['room_ID'])) {
				$room_ID = $_POST['room_ID'];
			 	$query .= '  WHERE res.room_ID = '.$room_ID.' ';
			}
		

		
		
			$statement1 = $teacher_attnd->runQuery($query);
			$statement1->execute();
			$result1 = $statement1->fetchAll();
			$data = array();
			$filtered_rows = $statement1->rowCount();
			$z = 1;
			$xzx="";


		



		$d = new DateTime($dnow);
		// Output the microseconds.
		 $d->format('u'); // 012345
		// Output the date with microseconds.
		$ndate = $d->format('Y-m-d'); 

		$query = "SELECT * FROM `room_student_attendance` WHERE room_ID=  '$room_ID' AND attendance_Time LIKE '$ndate%'";
		$statement = $teacher_attnd->runQuery($query);
		$statement->execute();
		if ($statement->rowCount() > 0){
		
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
					$res_ID = $row["res_ID"];
					$atndSt = $teacher_attnd->check_attendance_per_student($room_ID,$ndate,$res_ID);
					// $queryc = "SELECT attendance_Status FROM `room_student_attendance` WHERE res_ID = $res_ID AND attendance_Time LIKE '$ndate%' LIMIT 1";
					// $statement2 = $teacher_attnd->runQuery($queryc);
					// $statement2->execute();
					// $result2 = $statement2->fetchAll();
					// foreach($result2 as $row1)
					// {
					//    $atndSt = $row1["attendance_Status"];
					// }
					if ($atndSt == 0){
						$s_A = "selected";
						$s_P = "";
					}
					else{
						$s_A = "";
						$s_P = "selected";
					}
				
					$xzx .= '<tr>';
					$xzx .= '<td>'.$z.'</td>';
					$xzx .= '<td>'.$row["rsd_StudNum"].'</td>';
					$xzx .= '<td>'.ucwords(strtolower($row["rsd_FName"].' '.$row["rsd_MName"].'. '.$row["rsd_LName"].' '.$suffix)).'</td>';
					$xzx .= '<td>'.ucwords(strtolower($row["sex_Name"])).'</td>';
					$xzx .= '<td><input type="hidden" name="res_ID[]" value="'.$res_ID.'">
					   <select class="form-control" data="'.$res_ID.'" id="attendance_'.$z.'" name="attendance[]">
			                 <option value="1" '.$s_P.'>Present</option>
			                 <option value="0" '.$s_A.'>Absent</option>
			                </select></td>';
			        $xzx .= '</tr>';
			       
				$z ++;	

			}

			$output["operation"] = "update_attendance";
			$output["html"] = "update sample content";
			$output["html1"] = $xzx;
			$output["txt"] = "Update";



		}
		else
		{

			if ($statement1->rowCount() > 0){
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
					$res_ID = $row["res_ID"];
					
				
					$xzx .= '<tr>';
					$xzx .= '<td>'.$z.'</td>';
					$xzx .= '<td>'.$row["rsd_StudNum"].'</td>';
					$xzx .= '<td>'.ucwords(strtolower($row["rsd_FName"].' '.$row["rsd_MName"].'. '.$row["rsd_LName"].' '.$suffix)).'</td>';
					$xzx .= '<td>'.ucwords(strtolower($row["sex_Name"])).'</td>';
					$xzx .= '<td><input type="hidden" name="res_ID[]" value="'.$res_ID.'">
					   <select class="form-control" data="'.$res_ID.'" id="attendance_'.$z.'" name="attendance[]">
			                 <option value="1" >Present</option>
			                 <option value="0" >Absent</option>
			                </select></td>';
			        $xzx .= '</tr>';
			       
				$z ++;	

			}
			$output["operation"] = "submit_attendance";
			$output["html"] = "submit sample content";
			$output["html1"] = $xzx;
			$output["txt"] = "Submit";
			}
			else
			{
				$output["operation"] = "submit_empty";
				$output["html"] = "submit sample content";
				$output["html1"] ="";
				$output["txt"] = "Empty";

			}
		
		}
	}

	echo json_encode($output);
}
?>