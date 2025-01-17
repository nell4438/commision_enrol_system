<?php
require_once('../class.function.php');
$account = new DTFunction(); // Create new connection by passing in your configuration array

$query = '';
$output = array();
$query .= " 
SELECT 
`rsd`.`rsd_ID`,
`rsd`.`rsd_Img`,
`rsd`.`rsd_StudNum`,
`rsd`.`rsd_FName`,
LEFT(`rsd`.`rsd_MName`,1) rsd_MName,
`rsd`.`rsd_LName`,
`rsd`.`user_ID`,
`rs`.`sex_Name`,
`rm`.`marital_Name`,
`sf`.`suffix`
";
$query .= "FROM `record_student_details` `rsd`
LEFT JOIN `ref_marital` `rm` ON `rm`.`marital_ID` = `rsd`.`marital_ID`
LEFT JOIN `ref_sex` `rs` ON `rs`.`sex_ID` = `rsd`.`sex_ID`
LEFT JOIN `ref_suffixname` `sf` ON `sf`.`suffix_ID` = `rsd`.`suffix_ID`";

if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE rsd_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_StudNum LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_FName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rsd_LName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR suffix LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR sex_Name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
    $columns = array('rsd_ID', 'rsd_StudNum', 'rsd_LName', 'sex_Name', 'marital_Name');
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY rsd_LName ASC ';
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

    if($row["rsd_MName"] ==" " || $row["rsd_MName"] == NULL || empty($row["rsd_MName"]) )
    {
        $mname = " ";
    }
    else
    {
        $mname = $row["rsd_MName"].'. ';
    }
    if(empty($row["user_ID"]))
    {
        $reg = "<span class='badge badge-danger'>Unregistered</span>";
        $acreg = "UN";
        $btnrg = '<button type="button" class="btn btn-success btn-sm gen_account" data-toggle="tooltip" data-html="true" title="Generate Account" id="'.$row["rsd_ID"].'">
          <i class="icon-gear" style="font-size: 20px;"></i>
        </button>
        ';
    }
    else
    {
        $reg = "<span class='badge badge-success'>Registered</span>";
        $acreg = "RG";
        $btnrg = '';
    }
    $sub_array = array();
        
    $sub_array[] = $row["rsd_ID"];
    $sub_array[] =  $row["rsd_StudNum"];
    $sub_array[] =  ucwords(strtolower($row["rsd_LName"].', '.$row["rsd_FName"].' '.$mname.' '.$suffix));
    $sub_array[] =  ucwords(strtolower($row["sex_Name"]));
    $sub_array[] =  ucwords(strtolower($row["marital_Name"]));
    $sub_array[] =  $reg;
    $sub_array[] = '
    <div class="btn-group">
      <button class="btn btn-info btn-sm view"  id="'.$row["rsd_ID"].'"><i class="icon-eye" style="font-size: 20px;"></i></button>
      <button class="btn btn-primary btn-sm edit"  id="'.$row["rsd_ID"].'"><i class="icon-database-edit2" style="font-size: 20px;"></i></button>
      '.$btnrg.'
    </div>
    ';
    $data[] = $sub_array;
}

$q = "SELECT * FROM `record_student_details`";
$filtered_rec = $account->get_total_all_records($q);

$output = array(
    "draw"                =>    intval($_POST["draw"]),
    "recordsTotal"        =>    $filtered_rows,
    "recordsFiltered"    =>    $filtered_rec,
    "data"                =>    $data
);
echo json_encode($output);
?>
