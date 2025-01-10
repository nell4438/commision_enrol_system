<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT * ";
$query .= "FROM `gradelevel_subject` `gsub`
LEFT JOIN `ref_subject` `rsub` ON `rsub`.`subject_ID` = `gsub`.`subject_ID`";



if (isset($_REQUEST['sem_ID'])) {
	$sem_ID = $_REQUEST['sem_ID'];
	$yl_ID = $_REQUEST['yl_ID'];
 	$query .= '   WHERE sem_ID = '.$sem_ID.' AND yl_ID = '.$yl_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(grls_ID LIKE "%'.$_POST["search"]["value"].'%" )';
}


if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY grls_ID DESC ';
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
	
		
		$sub_array[] = $row["grls_ID"];
		$sub_array[] =  $row["subject_Code"];
		$sub_array[] =  $row["subject_Title"];
		$sub_array[] = '
		<div class="btn-group">
		  <button class="btn btn-danger btn-sm delete"  id="'.$row["grls_ID"].'" ><i class="icon-cross" style="font-size: 20px;"></i></button>
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



        
