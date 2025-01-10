<?php
require_once('../class.function.php');
$admission = new DTFunction(); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../assets/plugins/phpmailer/src/Exception.php';
require '../../../assets/plugins/phpmailer/src/PHPMailer.php';
require '../../../assets/plugins/phpmailer/src/SMTP.php';

$mail = new PHPMailer;

if(isset($_POST["operation"]))
{

	

	if($_POST["operation"] == "confirm_admission")
	{
		
		

		$admission_ID = $_POST["admission_ID"];

		$sql = "UPDATE `admission_student_details` SET `admission_Status` = '1' WHERE `admission_student_details`.`admission_ID` = :admission_ID;";
		$statement = $admission->runQuery($sql);
			
		$result = $statement->execute(
		array(
				':admission_ID'	=>	$_POST["admission_ID"],
			)
		);
		if(!empty($result))
		{

			$sql = "SELECT * FROM `admission_student_details` WHERE admission_ID = :id";
			$statement = $admission->runQuery($sql);
			$result = $statement->execute(
				array(
				':id'		=>	$admission_ID
				)
			);
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$admission_Email = $row["admission_Email"];
				$yl_ID = $row["yl_ID"];
			}

			if(!empty($result))
			{

				$mail->isSMTP(); 


				$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
				$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
				$mail->Port = 587; // TLS only
				$mail->SMTPSecure = 'tls'; // ssl is depracated
				$mail->SMTPAuth = true;
				$mail->Username = "addatujhasper0@gmail.com";
				$mail->Password = "aifoczdjbmylcsoo";


				// $admission_ID = 1;
				$mail->setFrom("addatujhasper0@gmail.com", "ONLINE ENROLMENT SYSTEM, SNHS MAIN");
				$mail->addAddress($admission_Email);
				// $mail->addAddress("mronel.com");
				$mail->Subject = 'Your Enrollment Registration Approve';
				$mail->msgHTML("<html>
				                <head>
				                <title>Your Enrollment Registration Approve</title>
				                </head>
				                <body>
				                <h4>Kindly pass the required documents</h4>
				                <h2>REQUIREMENTS</h2>
				                <h3>(Grade and Transferees)</h3>
				                <ul>
				                    <li> Report Card</li>
				                    <li> Photocopy of Birth Certificate</li>
				                    <li> 3 pcs 1x1 ID Picture</li>
				                    <li> Good Moral Certificate</li>
				                    <li> Barangay Clearance</li>
				                    <li> Brown Envelope (Long)</li>
				                    <li> Financial Assessment (from private school)</li>
				                </ul>
				                
				                <a href='http://localhost/enrol/index?page=admission-files&admission_ID=$admission_ID'>UPLOAD SCAN DOCUMENT HERE</a>
				                </body>
				                </html>"); 
				$mail->AltBody = 'Enrollment Registration Approve';
				// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

				if(!$mail->send()){
				    echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else{
				   echo 'Successfully Confirm & Sent Email';
				}



				  

				
			}	
		}


	

	
	
	}

	if($_POST["operation"] == "confirm_enrolled")
	{
		try{

			$admission_ID = $_POST["admission_ID"];

			$sql = "UPDATE `admission_student_details` SET `admission_Status` = '3' WHERE `admission_student_details`.`admission_ID` = :admission_ID;";
			$statement = $admission->runQuery($sql);
				
			$result = $statement->execute(
			array(
					':admission_ID'	=>	$_POST["admission_ID"],
				)
			);

			$sql = "SELECT * FROM `admission_student_details` WHERE admission_ID = :id";
			$statement = $admission->runQuery($sql);
			$result = $statement->execute(
				array(
				':id'		=>	$admission_ID
				)
			);
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$admission_Email = $row["admission_Email"];
				$admission_StudNum = $row["admission_StudNum"];

				$yl_ID = $row["yl_ID"];
			}

			$gas =	$admission->get_active_sem();
			foreach($gas as $row)
			{
				$semyear = $row["sem_year"];
				$sem_ID = $row["sem_ID"];
			}
			$gsbl =	$admission->get_student_by_lrn($admission_StudNum);
			foreach($gsbl as $row1)
			{
				$rsd_ID = $row1["rsd_ID"];
				$rsd_StudNum = $row1["rsd_StudNum"];
			}

			if (empty($rsd_ID)){
				 echo 'Failed to add in enrolled student. <br>If New: Student must add first in record';
			}
			else
			{

				$sqlx1 = "SELECT * FROM `record_student_enrolled` 
				WHERE rsd_ID = $rsd_ID AND sem_ID = $sem_ID OR yl_ID = $yl_ID";
				$statementx1z = $admission->runQuery($sqlx1);
				$resultx1x = $statementx1z->execute();

				if($statementx1z->rowCount() > 0)
				{
					// UPDATE `admission_student_details` SET `admission_Status` = '4' WHERE `admission_student_details`.`admission_ID` = 4;
					echo 'Already been added';
				}
				else
				{
					$sql2 = " INSERT INTO `record_student_enrolled` 
							   (`rse_ID`,
							    `rsd_ID`,
							     `sem_ID`,
							      `yl_ID`) VALUES (NULL, '$rsd_ID ', '$sem_ID', '$yl_ID');";
						$statement2 = $admission->runQuery($sql2);
						$result2 = $statement2->execute();
					
						if(!empty($result2))
						{
							$mail->isSMTP(); 
							
							$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
							$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
							$mail->Port = 587; // TLS only
							$mail->SMTPSecure = 'tls'; // ssl is depracated
							$mail->SMTPAuth = true;
							$mail->Username = "addatujhasper0@gmail.com";
							$mail->Password = "aifoczdjbmylcsoo";

							// $admission_ID = 1;
							$mail->setFrom("addatujhasper0@gmail.com", "ONLINE ENROLMENT SYSTEM, SNHS MAIN");
							$mail->addAddress($admission_Email);
							// $mail->addAddress("rhalpdarrencabrera@gmail.com");
							$mail->Subject = 'Your Enrollment Registration Complete';
							$mail->msgHTML("<html>
							                <head>
							                <title>You are now currently enrolled this year.</title>
							                </head>
							                <body>
							                <h4>Good luck.</h4>
							                </body>
							                </html>"); 
							$mail->AltBody = ' Enrollment Registration Complete';
							// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

							if(!$mail->send()){
							    echo "Mailer Error: " . $mail->ErrorInfo;
							}
							else{
							   echo 'Successfully Confirm & Sent Email';
							}



							echo 'Successfully Enrolled';
						}
				}
				
			}
		}
		catch (PDOException $e)
		{
		    echo "There is some problem in connection: " . $e->getMessage();
		}
	
	}

	if($_POST["operation"] == "delete_Admission")
	{
		$statement = $admission->runQuery(
			"DELETE FROM `admission_student_details` WHERE `admission_ID` = :admission_ID"
		);
		$result = $statement->execute(
			array(
				':admission_ID'	=>	$_POST["admission_ID"]
			)
		);
		
		if(!empty($result))
		{
			echo 'Successfully Deleted';
		}
		
	
	}
}

?>

