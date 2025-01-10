<?php 
include('../session.php');


require_once("../class.user.php");

  
$stud_attnd = new USER();

$room_ID = $_POST["room_ID"];
$year = $_POST["date"];





if(isset($_POST["operation"]))
{

	$output = array();
	if($_POST["operation"] == "fetch_attcount")
	{	
		$output["absent"] = $stud_attnd->day_absent($room_ID,$year);
		$output["present"] = $stud_attnd->day_present($room_ID,$year);

	}

	echo json_encode($output);
}
?>