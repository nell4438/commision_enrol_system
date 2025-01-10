<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT *";
$query .= " FROM `academic_staff` `acs`
LEFT JOIN `ref_subject` `sub` ON `sub`.subject_ID = `acs`.subject_ID
LEFT JOIN `record_instructor_details` `rid` ON `rid`.`rid_ID` = `acs`.`rid_ID`
LEFT JOIN `ref_position` `pos` ON `pos`.`pos_ID` = `acs`.`pos_ID`
LEFT JOIN `ref_suffixname` `sf` ON `sf`.`suffix_ID` = `rid`.`suffix_ID`
";




if (isset($_REQUEST['semester'])) {
	$semester_ID = $_REQUEST['semester'];
 	$query .= '  WHERE `acs`.`sem_ID` = '.$semester_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(rid_EmpID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rid_Fname LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rid_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rid_Lname LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR subject_Title LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR suffix LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY acs_ID ASC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $account->runQuery($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$i = 1;
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
		$sub_array = array();
	
		
		// $sub_array[] = $i;
		$sub_array[] = $row["acs_ID"];
		$sub_array[] = ucwords(strtolower($row["rid_FName"].' '.$row["rid_MName"].'. '.$row["rid_LName"].' '.$suffix));
		$sub_array[] = ucwords(strtolower($row["pos_Name"]));
		$sub_array[] = ucwords(strtolower($row["subject_Title"]));
		$sub_array[] = $row["rid_ID"];
		// $sub_array[] = '
  //         	<input type="hidden" name="student_id'.$row["res_ID"].'" value="'.$row["res_ID"].'">
  //       	<select class="custom-select" name="student_attendance'.$row["res_ID"].'">
		// 	  <option selected>Select option</option>
		// 	  <option value="1">Present</option>
		// 	  <option value="0">Absent</option>
		// 	</select>';
		  $i++;
	$data[] = $sub_array;
}


if (isset($_REQUEST['semester'])) {
	$q = "SELECT * FROM `academic_staff` where `sem_ID` = ". $_REQUEST['semester'];
}
else{
	 $q = "SELECT * FROM `academic_staff` ";
}
$filtered_rec = $account->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
