<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT 
	rm.room_ID,
	rid.rid_FName,
	rid.rid_MName,
	rid.rid_LName,
	rsn.suffix,
	sec.section_Name,
	rid.rid_ID,
	sec.section_ID,
	sem.sem_ID,

	CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear ,
	stat.status_Name,
	rm.yl_ID,
	ryl.yl_Name

	FROM `room` `rm`
	LEFT JOIN `ref_section` `sec` ON `sec`.`section_ID` = `rm`.`section_ID`
	LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `rm`.`rid_ID`
	LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rid`.`suffix_ID`
	LEFT JOIN `ref_semester` `sem` ON sem.sem_ID = `rm`.`sem_ID`
	LEFT JOIN `ref_status` `stat` ON `stat`.`status_ID` = `rm`.`status_ID`
	LEFT JOIN `ref_year_level` `ryl` ON `ryl`.`yl_ID` = `rm`.`yl_ID`

	WHERE rm.room_ID = '".$_POST["room_ID"]."' 
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
		$output["room_ID"] = $row["room_ID"];
		$output["semyear"] = $row["semyear"];
		$output["yl_Name"] = $row["yl_Name"];
		$output["yl_ID"] = $row["yl_ID"];
		$output["sem_ID"] = $row["sem_ID"];
		$output["section_ID"] = $row["section_ID"];
		$output["room_adviser"] =  $row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix;
	
	}
	
	echo json_encode($output);
	
}









 

?>