<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT 
res.res_ID,
rsd.rsd_ID,
rsd.user_ID,
rsd.rsd_StudNum,
rsd.rsd_Fname,
rsd.rsd_MName,
rsd.rsd_Lname,
sf.suffix";
$query .= " FROM `room_enrolled_student` `res`
LEFT JOIN `room` `rm` ON `rm`.`room_ID` = `res`.`room_ID`
LEFT JOIN `record_student_enrolled` `rse` ON `rse`.`rse_ID` = `res`.`rse_ID`
LEFT JOIN `record_student_details` `rsd` ON `rsd`.`rsd_ID` = `rse`.`rsd_ID`
LEFT JOIN `ref_suffixname` `sf` ON `sf`.`suffix_ID` = `rsd`.`suffix_ID`";




if (isset($_REQUEST['room_ID'])) {
	$room_ID = $_REQUEST['room_ID'];
 	$query .= '  WHERE `res`.`room_ID` = '.$room_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(rsd_StudNum LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_Fname LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_Lname LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR suffix LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY res_ID ASC ';
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
	
		
		$sub_array[] = $i;
		$sub_array[] = ucwords(strtolower($row["rsd_Fname"].' '.$row["rsd_MName"].'. '.$row["rsd_Lname"].' '.$suffix));
		$sub_array[] = '
		<div class="btn-group">
		  <button type="button" class="btn btn-danger delete_student_inroom" id="'.$row["res_ID"].'">Delete
		  </button>
		</div>';
		  $i++;
	$data[] = $sub_array;
}

$q = "SELECT * FROM `room_enrolled_student` where `room_ID` = ". $_REQUEST['room_ID'];
$filtered_rec = $account->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
