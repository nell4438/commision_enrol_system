<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT *,CONCAT(YEAR(sem_start),' - ',YEAR(sem_end)) semyear  ";
$query .= "FROM `ref_semester` `rs`
JOIN `ref_year_level`";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE sem_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR yl_Name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR  CONCAT(YEAR(sem_start)," - ",YEAR(sem_end))  LIKE "%'.$_POST["search"]["value"].'%" ';


}


if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY sem_ID DESC ';
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
	

	$sub_array = array();
	
		
		$sub_array[] = $row["sem_ID"].$row["stat_ID"].$row["yl_ID"];
		$sub_array[] =  ucwords($row["yl_Name"]);
		$sub_array[] =  $row["semyear"];
		$sub_array[] = '
		<div class="btn-group">
		  <button class="btn btn-info btn-sm view"  sem-id="'.$row["sem_ID"].'"  yl-id="'.$row["yl_ID"].'"><i class="icon-eye" style="font-size: 20px;"></i></button>
		</div>
		';
		// <div class="dropdown-divider"></div>
		//     <a class="dropdown-item delete" id="'.$row["grls_ID"].'">Delete</a>
	$data[] = $sub_array;
}

$q = "SELECT * FROM `ref_semester` `rs`
JOIN `ref_year_level`";
$filtered_rec = $account->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
