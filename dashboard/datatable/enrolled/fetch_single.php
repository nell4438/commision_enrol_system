<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT 
rse.rse_ID,
rse.rsd_ID,
rsd.rsd_FName,
rsd.rsd_MName,
rsd.rsd_LName,
sn.suffix,
CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear,
rse.sem_ID,
yl.yl_Name,
yl.yl_ID
FROM `record_student_enrolled` rse
LEFT JOIN record_student_details rsd ON rsd.rsd_ID = rse.rsd_ID
LEFT JOIN ref_semester sem ON sem.sem_ID = rse.sem_ID
LEFT JOIN ref_year_level yl ON yl.yl_ID = rse.yl_ID
LEFT JOIN ref_suffixname sn ON sn.suffix_ID = rsd.rsd_ID

WHERE rse.rse_ID =  '".$_POST["enrolled_ID"]."' 
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
		if($row["rsd_MName"] ==" " || $row["rsd_MName"] == NULL || empty($row["rsd_MName"]) )
		{
			$mname = " ";
		}
		else
		{
			$mname = $row["rsd_MName"].'. ';
		}
	
		
		$output["enrolled_ID"] = $row["rse_ID"];
		$output["student_ID"] = $row["rsd_ID"];
		$output["student_name"] = $row["rsd_FName"].' '.$mname.$row["rsd_LName"].' '.$suffix;
		$output["enrolled_acadyr"] = $row["sem_ID"];
		$output["enrolled_gradelevel"] = $row["yl_ID"];
	
	}
	
	echo json_encode($output);
	
}









 

?>