<?php
require_once('../class.function.php');
$account = new DTFunction(); 
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "submit_subject")
	{	
		try
		{
			$subject_ID   = $_POST["subject_ID"];
			$yl_ID   =  $_POST["yl_ID"];
			$sem_ID  = $_POST["sem_ID"];
			
			$q = "SELECT * FROM `gradelevel_subject` WHERE sem_ID = '$sem_ID' AND yl_ID = '$yl_ID' AND subject_ID = '$subject_ID' ";

			$smtp = $account->runQuery($q);
			$result = $smtp->execute();
			if ($smtp->rowCount() >0){
				echo 'Already been added';
			}
			else{
				$sql = "INSERT INTO `gradelevel_subject` (`grls_ID`, `sem_ID`, `yl_ID`, `subject_ID`) VALUES (NULL, '$sem_ID', '$yl_ID', '$subject_ID');";
				$smtp1 = $account->runQuery($sql);
				$update_result = $smtp1->execute();
				if(!empty($update_result))
				{
					echo 'Successfully Added';
				}
			}
			
			
			

		}
		catch (PDOException $e)
		{
		    echo "There is some problem in connection: " . $e->getMessage();
		}
		
	}

	

	if($_POST["operation"] == "delete_subject")
	{
		$statement = $account->runQuery(
			"DELETE FROM `gradelevel_subject` WHERE `grls_ID` = :grls_ID"
		);
		$result = $statement->execute(
			array(
				':grls_ID'	=>	$_POST["grls_ID"]
			)
		);
		
		if(!empty($result))
		{
			echo 'Successfully Deleted';
		}
		
	
	}
}
?>

