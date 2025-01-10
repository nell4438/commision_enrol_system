<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT *,
CONCAT(rid.rid_FName,' ',
RIGHT(rid.rid_MName,1),'. ',
rid.rid_LName,' ',
(SELECT IF (rsn.suffix = 'NA',rsn.suffix,''))      ) room_adviser
FROM `room` rm
LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `rm`.`rid_ID`
LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rid`.`suffix_ID`
WHERE room_ID = '".$_POST["room_ID"]."' 
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
	{

	
		
		$output["teacher_semester"] = $row["section_ID"];
		$output["teacher_section"] = $row["sem_ID"];
		$output["teacher_name"] = $row["room_adviser"];

	}
	
	echo json_encode($output);
	
}









 

?>