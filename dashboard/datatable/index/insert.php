<?php
require_once('../class.function.php');
$grading = new DTFunction(); 


if(isset($_POST["operation"]))
{
$output = array();
	if($_POST["operation"] == "grading_submit")
	{

		$rsg_ID = $_POST["rsg_ID"];
		$rsub_ID = $_POST["rsub_ID"];
		$res_ID = $_POST["res_ID"];
		$grading_first = $_POST["grading_first"];
		$grading_second = $_POST["grading_second"];
		$grading_third = $_POST["grading_third"];
		$grading_fourth = $_POST["grading_fourth"];
		$grading_remark = $_POST["grading_remarkx"];
		$grading_final = $_POST["final_grade_daw"];

		$sql = "INSERT INTO `room_student_grade` 
		(`rsg_ID`,
		 	`res_ID`,
		 	 `rsub_ID`,
		 	  `first`,
		 	   `second`,
		 	    `third`,
		 	     `fourth`,
		 	      `remarks`,
		 	       `final`) 
		VALUES 
		(NULL,
		'$res_ID', 
		 '$rsub_ID',
		  '$grading_first',
		   '$grading_second',
		    '$grading_third',
		     '$grading_fourth',
		      '$grading_remark',
		       '$grading_final');";
		$statement = $grading->runQuery($sql);
		$result = $statement->execute();
		if(!empty($result))
		{
			$output["success"] = 'Successfully Added';
			$output["op"] = "grading_submit";
		}

		
	}
	if($_POST["operation"] == "grading_update")
	{
		$rsg_ID = $_POST["rsg_ID"];
		$res_ID = $_POST["res_ID"];
		$grading_first = $_POST["grading_first"];
		$grading_second = $_POST["grading_second"];
		$grading_third = $_POST["grading_third"];
		$grading_fourth = $_POST["grading_fourth"];
		$grading_remark = $_POST["grading_remarkx"];
		$grading_final = $_POST["final_grade_daw"];	

		$sql = "UPDATE `room_student_grade` 
		SET `first` = '$grading_first' ,
		`second` = '$grading_second' ,
		`third` = '$grading_third' ,
		`fourth` = '$grading_fourth' ,
		`remarks` = '$grading_remark' ,
		`final` = '$grading_final' 
		WHERE `rsg_ID` = '$rsg_ID' ";
		$statement = $grading->runQuery($sql);
		$result = $statement->execute();
		if(!empty($result))
		{
			$output["success"] = 'Successfully Update';
			$output["op"] = 'grading_update';
		}

	}

	echo json_encode($output);
	
}
?>
