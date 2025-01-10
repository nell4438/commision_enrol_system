<?php 
include('../session.php');


require_once("../class.user.php");

  
$teacher_attnd = new USER();
$output = array();
$room_ID = $_REQUEST["room_ID"];


if ($teacher_attnd->student_level()){
$user_ID = $_SESSION['user_ID'];
$query = "
SELECT 
DISTINCT(`rsa`.`attendance_Time`),attendance_Status
FROM `room_student_attendance` rsa
LEFT JOIN room_enrolled_student res ON res.res_ID = rsa.res_ID
LEFT JOIN record_student_enrolled rse ON rse.rse_ID = res.rse_ID
LEFT JOIN record_student_details rsd ON rsd.rsd_ID = rse.rsd_ID

where rsa.room_ID = '$room_ID' AND rsd.user_ID =  '$user_ID'";
}
else{
	$query = "SELECT 
DISTINCT(`rsa`.`attendance_Time`)
FROM `room_student_attendance` rsa
where room_ID = '$room_ID'";
}




$statement = $teacher_attnd->runQuery($query);
$statement->execute();
$result = $statement->fetchAll();

foreach ($result as $row){
	$attendance_Time = strtotime($row["attendance_Time"]);
	$attnd_y = date("Y",$attendance_Time);	
	$attnd_m = date("m",$attendance_Time);	
	$attnd_d = date("d",$attendance_Time);	
	
	if($row["attendance_Status"] == 0){
		$xcc = "absent";
	}
	else{
		$xcc = "present";
	}

	$output["statx"][] = $xcc;
	$output["full_date"][] = $row["attendance_Time"];
	$output["year"][] = date("Y",$attendance_Time);
	$output["month"][] = date("m",$attendance_Time);
	$output["dayz"][] = date("d",$attendance_Time);

	
}

echo json_encode($output);
?>