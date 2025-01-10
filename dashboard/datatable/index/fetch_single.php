<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT * FROM `room_student_grade` WHERE res_ID = '".$_POST["res_ID"]."' AND rsub_ID = '".$_POST["rsub_ID"]."'   
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();

	if($stmt->rowCount() > 0){
		$output["gbtn_z"] = "grading_update" ;
		$output["gbtn_zt"] = "Update" ;

	}
	else{

		$output["gbtn_z"] = "grading_submit" ;
		$output["gbtn_zt"] = "Submit" ;
	}
	foreach($result as $row)
	{

		$output["rsg_ID"] = $row["rsg_ID"];
		$output["res_ID"] = $row["res_ID"];
		$output["grading_first"] = $row["first"];
		$output["grading_second"] = $row["second"];
		$output["grading_third"] = $row["third"];
		$output["grading_fourth"] = $row["fourth"];
		$output["grading_remark"] = $row["remarks"];
		$output["grading_final"] = $row["final"];
	}
	
	echo json_encode($output);
	
}









 

?>