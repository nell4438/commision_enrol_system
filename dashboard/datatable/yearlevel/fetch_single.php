<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT * FROM `ref_year_level` WHERE yl_ID  = '".$_POST["yl_ID"]."' 
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
	{

	
		
		$output["yl_ID"] = $row["yl_ID"];
		$output["yl_Name"] = $row["yl_Name"];
	
	}
	
	echo json_encode($output);
	
}









 

?>