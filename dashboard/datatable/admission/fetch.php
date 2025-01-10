<?php
require_once('../class.function.php');
$admission = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT 
*,
(
	IF
	(
		`adm`.`admission_Status` = 1, 
		'<span class=\'badge badge-primary\'>PENDING REQUIREMENTS</span>'
		,
		(
			IF
			(`adm`.`admission_Status` = 2, 
			'<span class=\'badge badge-info\'>REQUIREMENTS COMPLETE</span>',
				(
					IF(`adm`.`admission_Status` = 3, 
					'<span class=\'badge badge-success\'>ENROLMENT COMPLETE</span>',
					'<span class=\'badge badge-danger\'>PENDING CONFIRMATION</span>')
				)

			)
		)
	)
) `a_status`  ";
$query .= "FROM `admission_student_details` `adm`
LEFT JOIN `ref_year_level` `yl` ON `yl`.`yl_ID` = `adm`.`yl_ID`
LEFT JOIN `ref_suffixname` `rsf` ON `rsf`.`suffix_ID` = `adm`.`suffix_ID`";


if (isset($_REQUEST['admission_status'])) {
	$admission_status = $_REQUEST['admission_status'];
 	$query .= '  WHERE `adm`.`admission_Status` = '.$admission_status.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(admission_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR admission_FName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR admission_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR admission_LName LIKE "%'.$_POST["search"]["value"].'%" )';
}





if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY admission_ID DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $admission->runQuery($query);
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
		if($row["admission_MName"] ==" " || $row["admission_MName"] == NULL || empty($row["admission_MName"]) )
		{
			$mname = " ";
		}
		else
		{
			$mname = $row["admission_MName"].'. ';
		}

		if($row["cf_ID"] =="1")
		{
			$cf = "New";
		}
		else if($row["cf_ID"] =="2")
		{
			$cf = "Old";
		}
		else if($row["cf_ID"] =="3")
		{
			$cf = "Transferee";
		}
		else{
			$cf = "";
		}

		

		$sub_array = array();

		$sub_array[] = $row["admission_ID"];
		$sub_array[] =  $row["admission_Date"];
		$sub_array[] =  $row["admission_StudNum"];
		$sub_array[] =  $cf;
		$sub_array[] =  ucwords(strtolower($row["yl_Name"]));
		$sub_array[] = ucwords(strtolower($row["admission_FName"].' '.$mname.$row["admission_LName"].' '.$suffix));
		$sub_array[] =  $row["a_status"];
		if ($row["admission_Status"]== 0){
			$czf = '<button class="btn btn-secondary btn-sm confirm"  id="'.$row["admission_ID"].'">Confirm <i class="icon-checkmark2" style="font-size: 20px;"></i></button>
			';
		}
		else if ($row["admission_Status"]== 2){
			$czf = '
			<button class="btn btn-secondary btn-sm confirm_enrolled"  id="'.$row["admission_ID"].'">Confirm Enrolled <i class="icon-checkmark2" style="font-size: 20px;"></i></button>
			';
			
		}
		else{
			$czf = '';
		}
		$sub_array[] = '
		<div class="btn-group-vertical">
		  <button class="btn btn-info btn-sm view"  id="'.$row["admission_ID"].'"><i class="icon-eye" style="font-size: 20px;"></i></button>
		  '.$czf.'
		</div>';

		// <div class="btn-group">
		//   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		//     Action
		//   </button>
		//   <div class="dropdown-menu">
		//     <a class="dropdown-item view"  id="'.$row["admission_ID"].'">View</a>
		//     '.$czf.'
		    
		//   </div>
		// </div>
		// <div class="dropdown-divider"></div>
		// <a class="dropdown-item delete" id="'.$row["admission_ID"].'">Delete</a>
		


	
	$data[] = $sub_array;
}

$q = "SELECT * FROM `admission_student_details`";
$filtered_rec = $admission->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
