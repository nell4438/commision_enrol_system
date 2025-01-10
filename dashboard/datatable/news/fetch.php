<?php
require_once('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT 
* ";
$query .= "FROM `news` `n`";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE news_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR news_Title LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR news_Pub LIKE "%'.$_POST["search"]["value"].'%" ';
}


if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY news_ID DESC ';
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
	if(isset($_REQUEST["x"])){
		
		$sub_array[] = $row["news_ID"];
		$sub_array[] =  $row["news_Title"];
	    $news_Pub = strtotime($row["news_Pub"]);
		$sub_array[] =  date("Y-m-d h:i:sa",$news_Pub);
		// $sub_array[] =  $row["sem_year"];
		$sub_array[] = '

		<div class="btn-group">
		  <button class="btn btn-info btn-sm view"  id="'.$row["news_ID"].'"><i class="icon-eye" style="font-size: 20px;"></i></button>
		  <button class="btn btn-primary btn-sm edit"  id="'.$row["news_ID"].'"><i class="icon-database-edit2" style="font-size: 20px;"></i></button>
		  <button class="btn btn-danger btn-sm delete"  id="'.$row["news_ID"].'"><i class="icon-cross2" style="font-size: 20px;"></i></button>
		</div>
		';
		
	}
	else{
	// $sub_array[] = $row["news_ID"];
	$sub_array[] =  $row["news_Title"];
    $news_Pub = strtotime($row["news_Pub"]);
	$sub_array[] =  date("Y-m-d h:i:sa",$news_Pub);
	// $sub_array[] =  $row["sem_year"];

	$sub_array[] = '
		  <a href="index?page=news&content='.$row["news_ID"].'"  class="btn btn-primary" >
		    READ
		  </a>
		';
	}
	
	$data[] = $sub_array;
}

$q = "SELECT * FROM `news`";
$filtered_rec = $account->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
