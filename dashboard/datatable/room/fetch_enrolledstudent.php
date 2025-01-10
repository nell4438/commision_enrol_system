<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array
// print_r($_POST);
// return 0;

$query = '';
$output = array();
$query .= "SELECT 
rse.rse_ID,
rsd.rsd_FName,
rsd.rsd_MName,
rsd.rsd_LName,
rsn.suffix";
$query .= " FROM `record_student_enrolled` `rse`
LEFT JOIN `record_student_details` `rsd` ON `rsd`.`rsd_ID` = `rse`.`rsd_ID`
LEFT JOIN `ref_suffixname` `rsn` ON `rsn`.`suffix_ID` = `rsd`.`suffix_ID`";




if (isset($_REQUEST['sem_ID'])) {
	$yl_ID = $_REQUEST['yl_ID'];
	$sem_ID = $_REQUEST['sem_ID'];
 	$query .= '  WHERE rse.sem_ID = '.$sem_ID.' AND rse.yl_ID = '.$yl_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(rsd_FName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_LName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR suffix LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY rse_ID DESC ';
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
	
		
		$sub_array[] = $row["rse_ID"];
		$sub_array[] = ucwords(strtolower($row["rsd_FName"].' '.$row["rsd_MName"].'. '.$row["rsd_LName"].' '.$suffix));
		
	$data[] = $sub_array;
}
if (isset($_REQUEST['sem_ID'])) {

	$q = 'SELECT * FROM `record_student_enrolled` `rse` WHERE `rse`.`sem_ID` = '.$sem_ID.' AND `rse`.`yl_ID` = '.$yl_ID ;
}
else{

	$q = "SELECT * FROM `record_student_enrolled` `rse` ";
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



        
