<?php
require_once('../class.function.php');
$acadstaff = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $acadstaff->runQuery("SELECT 
	`acs`.`acs_ID`,
`rid`.`rid_Img`,
`rid`.`rid_FName`,
`rid`.`rid_MName`,
`rid`.`rid_LName`,
`rsf`.`suffix`,
`rp`.`pos_Name`,
`rs`.`subject_ID`,
`rp`.`pos_ID`,
`rsem`.`sem_ID`
FROM `academic_staff` `acs`
LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `acs`.`rid_ID`
LEFT JOIN `ref_position` `rp` ON `rp`.`pos_ID` = `acs`.`pos_ID`
LEFT JOIN `ref_subject` `rs` ON `rs`.`subject_ID` = `acs`.`subject_ID`
LEFT JOIN `ref_semester` `rsem` ON `rsem`.`sem_ID` = `acs`.`sem_ID`
LEFT JOIN `ref_suffixname` `rsf` ON `rsf`.`suffix_ID` = `rid`.`suffix_ID`
 WHERE acs_ID  = '".$_POST["staff_ID"]."' 
			LIMIT 1");
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
	
		
		$output["acs_ID"] = $row["acs_ID"];
		$output["staff_name"] =  $row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix;
		$output["pos_ID"] = $row["pos_ID"];
		$output["subject_ID"] = $row["subject_ID"];
		$output["sem_ID"] = $row["sem_ID"];
	
	}
	
	echo json_encode($output);
	
}









 

?>