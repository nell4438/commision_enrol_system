<?php
require_once('../class.function.php');
$admission = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $admission->runQuery("SELECT * 
		FROM `admission_student_details` 
		`adm`
		LEFT JOIN `ref_year_level` `yl` ON `yl`.`yl_ID` = `adm`.`yl_ID`
		LEFT JOIN `ref_suffixname` `rsf` ON `rsf`.`suffix_ID` = `adm`.`suffix_ID`
		LEFT JOIN `ref_sex` `sx` ON `sx`.`sex_ID` = `adm`.`sex_ID`
		WHERE `adm`.admission_ID  = '".$_POST["admission_ID"]."' 
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
		if($row["admission_MName"] ==" " || $row["admission_MName"] == NULL || empty($row["admission_MName"]) )
		{
			$mname = " ";
		}
		else
		{
			$mname = $row["admission_MName"].'. ';
		}

		$output["admission_ID"] = $row["admission_ID"];
		$output["admission_StudNum"] = $row["admission_StudNum"];
		$output["admission_FName"] = $row["admission_FName"];
		$output["admission_MName"] = $row["admission_MName"];
		$output["admission_LName"] = $row["admission_LName"];
		$output["suffix_ID"] = $row["suffix_ID"];
		$output["sex_ID"] = $row["sex_ID"];
		$output["sex_Name"] = $row["sex_Name"];
		$output["admission_Email"] = $row["admission_Email"];
		$output["admission_Bday"] = $row["admission_Bday"];
		$output["admission_Address"] = $row["admission_Address"];
		$output["admission_Height"] = $row["admission_Height"];
		$output["admission_BMIStat"] = $row["admission_BMIStat"];
		$output["admission_Weight"] = $row["admission_Weight"];
		$output["admission_House"] = $row["admission_House"];
		$output["admission_Parent"] = $row["admission_Parent"];
		$output["admission_Contact"] = $row["admission_Contact"];
		$output["admission_Altcontact"] = $row["admission_Altcontact"];
		$output["admission_ParentWork"] = $row["admission_ParentWork"];
		$output["admission_Living"] = $row["admission_Living"];
		$output["admission_FeedProgReason"] = $row["admission_FeedProgReason"];
		$output["admission_DewormingReason"] = $row["admission_DewormingReason"];
		$output["admission_medDecease"] 	= json_decode($row["admission_medDecease"]) ;
		$output["admission_medDeceaseDate"] 	= json_decode($row["admission_medDeceaseDate"]) ;
		$output["yl_ID"] = $row["yl_ID"];
		$output["yl_Name"] = $row["yl_Name"];
		$output["admission_Date"] = $row["admission_Date"];
		$output["admission_Status"] = $row["admission_Status"];


		$output["admission_Name"] = $row["admission_FName"].' '.$mname.$row["admission_LName"].' '.$suffix;
		
	
	}
	
	echo json_encode($output);
	
}









 

?>