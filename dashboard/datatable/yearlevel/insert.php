<?php
require_once('../class.function.php');
$account = new DTFunction(); 
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "submit_yearlevel")
	{	
		try
		{
			$yearlevel_name = $_POST["yearlevel_name"];
			$sql = "INSERT INTO `ref_year_level` 
			(`yl_ID`, `yl_Name`) 
			VALUES 
			(NULL, :yearlevel_name);";
				$statement = $account->runQuery($sql);
					
				$result = $statement->execute(
				array(

						':yearlevel_name'		=>	$yearlevel_name ,
					)
				);
				if(!empty($result))
				{
					echo 'Successfully Added';
				}

		}
		catch (PDOException $e)
		{
		    echo "There is some problem in connection: " . $e->getMessage();
		}
		
	}

	if($_POST["operation"] == "yearlevel_update")
	{
		
		

		$yearlevel_name = $_POST["yearlevel_name"];

		$sql = "UPDATE `ref_year_level` SET `yl_Name` = :yearlevel_name WHERE `yl_ID` =  :yl_ID;";
		$statement = $account->runQuery($sql);
			
		$result = $statement->execute(
		array(
				':yl_ID'	=>	$_POST["yl_ID"],
				':yearlevel_name'		=>	$yearlevel_name ,
			)
		);
		if(!empty($result))
		{
			echo 'Successfully Updated';
		}
	
	}

	if($_POST["operation"] == "delete_yearlevel")
	{
		$statement = $account->runQuery(
			"DELETE FROM `ref_year_level` WHERE `yl_ID` = :yl_ID"
		);
		$result = $statement->execute(
			array(
				':yl_ID'	=>	$_POST["yl_ID"]
			)
		);
		
		if(!empty($result))
		{
			echo 'Successfully Deleted';
		}
		
	
	}
}
?>

