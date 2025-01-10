<?php
require_once('../class.function.php');
$account = new DTFunction(); 
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "submit_enrolled")
	{	
		
		$enrolled_acadyr = $_POST["enrolled_acadyr"];
		$enrolled_gradelevel = $_POST["enrolled_gradelevel"];
		$student_ID = $_POST["student_ID"];

		$sql1 = "SELECT * FROM `record_student_enrolled` WHERE rsd_ID = $student_ID AND sem_ID = $enrolled_acadyr OR yl_ID = $enrolled_gradelevel";
		$statement1 = $account->runQuery($sql1);
		$result = $statement1->execute();
		if($statement1->rowCount() > 0){
			echo 'Already been added';
		}
		else{
			$sql = "INSERT INTO `record_student_enrolled` (
			`rse_ID`,
			 `rsd_ID`,
			  `sem_ID`, 
			  `yl_ID`) 
			  VALUES (NULL, :student_ID, :enrolled_acadyr, :enrolled_gradelevel);";
			$statement = $account->runQuery($sql);
				
			$result = $statement->execute(
			array(
					':student_ID'	=>	$student_ID,
					':enrolled_acadyr'		=>	$enrolled_acadyr ,
					':enrolled_gradelevel'		=>	$enrolled_gradelevel ,
				)
			);
			if(!empty($result))
			{
				echo 'Successfully Added';
			}
		}

		

		
	}

	if($_POST["operation"] == "enrolled_edit")
	{
		
		

		
		$enrolled_acadyr = $_POST["enrolled_acadyr"];
		$enrolled_gradelevel = $_POST["enrolled_gradelevel"];
		$student_ID = $_POST["student_ID"];
		$enrolled_ID = $_POST["enrolled_ID"];

		$sql = "UPDATE `record_student_enrolled` 
		SET 
		`sem_ID` = :enrolled_acadyr, 
		 `yl_ID`= :enrolled_gradelevel 
		WHERE `record_student_enrolled`.`rse_ID` = :enrolled_ID;";
		$statement = $account->runQuery($sql);
			
		$result = $statement->execute(
		array(
				':enrolled_ID'		=>	$enrolled_ID ,
				':enrolled_gradelevel'		=>	$enrolled_gradelevel ,
				':enrolled_acadyr'		=>	$enrolled_acadyr ,
			)
		);
		if(!empty($result))
		{
			echo 'Successfully Updated';
		}
	
	}

	if($_POST["operation"] == "delete_enrolled")
	{
		$statement = $account->runQuery(
			"DELETE FROM `record_student_enrolled` WHERE `rse_ID` = :enrolled_ID"
		);
		$result = $statement->execute(
			array(
				':enrolled_ID'	=>	$_POST["enrolled_ID"]
			)
		);
		
		if(!empty($result))
		{
			echo 'Successfully Deleted';
		}
		
	
	}
}
?>

