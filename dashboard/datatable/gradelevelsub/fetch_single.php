<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT *,CONCAT(YEAR(sem_start),' - ',YEAR(sem_end)) semyear  FROM `ref_semester` `rs`
JOIN `ref_year_level` WHERE sem_ID = '".$_POST["sem_ID"]."' AND yl_ID = '".$_POST["yl_ID"]."' 
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
	{

	
		
		$output["gradelvl"] =  ucwords($row["yl_Name"]);
		$output["acadyear"] = $row["semyear"];
		$output["sem_ID"] = $row["sem_ID"];
		$output["yl_ID"] = $row["yl_ID"];
		
	
	}
	
	echo json_encode($output);
	
}









 

?>