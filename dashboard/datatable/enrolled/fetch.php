<?php
require_once ('../class.function.php');
$account = new DTFunction();  		 // Create new connection by passing in your configuration array
$query = '';
$output = array();
$query .= "SELECT 
rsd.rsd_ID,
rse.rse_ID,
rsd.rsd_FName,
rsd.rsd_MName,
rsd.rsd_LName,
sn.suffix AS student_suffix,
yl.yl_Name AS student_year_level,
CONCAT(YEAR(sem.sem_start), ' - ', YEAR(sem.sem_end)) AS semyear,
sec.section_Name,
CONCAT(rid.rid_FName, ' ', rid.rid_MName, ' ', rid.rid_LName) AS room_adviser ";

$query .= "FROM record_student_enrolled rse
LEFT JOIN record_student_details rsd ON rsd.rsd_ID = rse.rsd_ID
LEFT JOIN `ref_suffixname` `sn` ON `sn`.`suffix_ID` = `rsd`.`rsd_ID`
LEFT JOIN ref_year_level yl ON yl.yl_ID = rse.yl_ID
LEFT JOIN ref_semester sem ON sem.sem_ID = rse.sem_ID
LEFT JOIN room rm ON rm.section_ID = rse.section_ID
LEFT JOIN ref_section sec ON sec.section_ID = rm.section_ID
LEFT JOIN record_instructor_details rid ON rid.rid_ID = rm.rid_ID
LEFT JOIN ref_suffixname rsn ON rsn.suffix_ID = rid.suffix_ID;";
// $query .= "SELECT 
// rse.rse_ID,
// rse.rsd_ID,
// rsd.rsd_FName,
// rsd.rsd_MName,
// rsd.rsd_LName,
// sn.suffix,
// yl.yl_Name,
// CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear,
// yl.yl_Name ";
// $query .= "FROM `record_student_enrolled` `rse`
// LEFT JOIN `record_student_details` `rsd` ON `rsd`.`rsd_ID` = `rse`.`rsd_ID`
// LEFT JOIN `ref_semester` `sem` ON `sem`.`sem_ID` = `rse`.`sem_ID`
// LEFT JOIN `ref_year_level` `yl` ON `yl`.`yl_ID` = `rse`.`yl_ID`
// LEFT JOIN `ref_suffixname` `sn` ON `sn`.`suffix_ID` = `rsd`.`rsd_ID`";
if (isset($_POST["search"]["value"])) {
	$query .= 'WHERE rse_ID LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR rsd_FName LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR rsd_MName LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR rsd_LName LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR suffix LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR CONCAT(YEAR(sem.sem_start)," - ",YEAR(sem.sem_end)) LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR student_year_level LIKE "%' . $_POST["search"]["value"] . '%" ';
}


if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
	$query .= 'ORDER BY rse_ID DESC ';
}
if ($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $account->runQuery($query);
$statement->execute();
$result = $statement->fetchAll();
$statement->closeCursor();
// print_r($result);
// return 0;
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {


	$sub_array = array();

	if ($row["student_suffix"] == "N/A") {
		$suffix = "";
	} else {
		$suffix = $row["student_suffix"];
	}
	if ($row["rsd_MName"] == " " || $row["rsd_MName"] == NULL || empty($row["rsd_MName"])) {
		$mname = " ";
	} else {
		$mname = $row["rsd_MName"] . '. ';
	}

	$sub_array[] = $row["rse_ID"];
	$sub_array[] = ucwords(strtolower($row["rsd_FName"] . ' ' . $mname . $row["rsd_LName"] . ' ' . $suffix));
	$sub_array[] = $row["semyear"];
	$sub_array[] = ucwords(strtolower($row["student_year_level"]));
	$sub_array[] = $row["section_Name"];
	$sub_array[] = $row["room_adviser"];
	$sub_array[] = '
	
		<div class="btn-group">
		  <button class="btn btn-info btn-sm view"  id="' . $row["rse_ID"] . '"><i class="icon-eye" style="font-size: 20px;"></i></button>
		  <button class="btn btn-primary btn-sm edit"  id="' . $row["rse_ID"] . '"><i class="icon-database-edit2" style="font-size: 20px;"></i></button>
		</div>
		';
	// <div class="dropdown-divider"></div>
	//    <a class="dropdown-item delete" id="'.$row["rse_ID"].'">Delete</a>



	$data[] = $sub_array;
}
// print_r($data);
$q = "SELECT * FROM `record_student_enrolled`";

$filtered_rec = $account->get_total_all_records($q);

$output = array(
	"draw" => intval($_POST["draw"]),
	"recordsTotal" => $filtered_rows,
	"recordsFiltered" => $filtered_rec,
	"data" => $data
);
// print_r($output);
echo json_encode($output);



?>