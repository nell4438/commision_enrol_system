<?php
require_once ('../class.function.php');
$room = new DTFunction();

if (isset($_POST["operation"])) {

	if ($_POST["operation"] == "submit_room") {
		try {
			$teacher_ID = $_POST["teacher_ID"];
			$yearlvl = $_POST["teacher_yearlvl"];
			$section_ID = $_POST["teacher_section"];
			$semester_ID = $_POST["teacher_semester"];

			$q = "SELECT * FROM `ref_semester` WHERE sem_ID = " . $semester_ID . ";";
			$s1 = $room->runQuery($q);
			$s1->execute();
			$r1 = $s1->fetchAll();
			foreach ($r1 as $rz) {

				if ($rz["stat_ID"] == 0) {
					$status_ID = 2;
				} else {
					$status_ID = 1;
				}
			}

			$qx = "SELECT * FROM `room` WHERE rid_ID = " . $teacher_ID . " AND sem_ID =  " . $semester_ID . " AND yl_ID = " . $yearlvl . ";";
			$s1x = $room->runQuery($qx);
			$s1x->execute();
			if ($s1x->rowCount() > 0) {
				echo 'Already been added';
			} else {
				$sql = "INSERT INTO `room` 
				(`room_ID`,
				 `rid_ID`,
				  `section_ID`,
				   `sem_ID`,
				    `status_ID`,`yl_ID`) 
				    VALUES (
				    NULL,
				     :teacher_ID,
				      :section_ID,
				       :semester_ID,
				        :status_ID,
				    	:yl_ID);";
				$statement = $room->runQuery($sql);

				$result = $statement->execute(
					array(

						':teacher_ID' => $teacher_ID,
						':section_ID' => $section_ID,
						':semester_ID' => $semester_ID,
						':status_ID' => $status_ID,
						':yl_ID' => $yearlvl,


					)
				);
				if (!empty($result)) {
					echo 'Successfully Added';
				}
			}



		} catch (PDOException $e) {
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}


	if ($_POST["operation"] == "room_edit") {
		echo "updated";
	}
	if ($_POST["operation"] == "submit_room_student") {
		// print_r($_POST);
		// return 0;
		$enrolled_ID = $_POST["enrolled_ID"];
		$room_ID = $_POST["room_ID"];
		$section_ID = $_POST["section_ID"];

		$sql1 = "SELECT * FROM `room_enrolled_student` WHERE rse_ID = $enrolled_ID  AND room_ID = $room_ID";
		$statement1 = $room->runQuery($sql1);
		$result = $statement1->execute();
		if ($statement1->rowCount() > 0) {
			echo 'Already been added';
		} else {

			$sql = "INSERT INTO `room_enrolled_student` 
			(`res_ID`, `rse_ID`, `room_ID`) 
			VALUES (NULL, :enrolled_ID, :room_ID);";
			$statement = $room->runQuery($sql);

			$result = $statement->execute(
				array(
					':enrolled_ID' => $enrolled_ID,
					':room_ID' => $room_ID
				)
			);
			if (!empty($result)) {
				echo 'Successfully Added';
			}

			$sql2 = "UPDATE `record_student_enrolled` SET `section_ID` = :section_ID WHERE `rse_ID` = :enrolled_ID";
			$statement = $room->runQuery($sql2);
			$statement->execute(
				array(
					':section_ID' => $section_ID,
					':enrolled_ID' => $enrolled_ID,
				)
			);
		}



	}
	if ($_POST["operation"] == "submit_room_subject") {




		$acadsub_ID = $_POST["acadsub_ID"];
		$room_ID = $_POST["room_ID"];
		$sql1 = "SELECT * FROM `room_subject` WHERE acs_ID = $acadsub_ID  AND room_ID = $room_ID";
		$statement1 = $room->runQuery($sql1);
		$result = $statement1->execute();
		if ($statement1->rowCount() > 0) {
			echo 'Already been added';
		} else {
			$sql = "INSERT INTO `room_subject` 
			(`rsub_ID`, `room_ID`, `acs_ID`)
			VALUES (NULL,  :room_ID,:acadsub_ID);";
			$statement = $room->runQuery($sql);

			$result = $statement->execute(
				array(
					':acadsub_ID' => $acadsub_ID,
					':room_ID' => $room_ID,
				)
			);
			if (!empty($result)) {
				echo 'Successfully Added';
			}
		}



	}


	if ($_POST["operation"] == "delete_room") {

		$room_ID = $_POST["room_ID"];
		$del_es = $room->runQuery("DELETE FROM  `room_enrolled_student` WHERE  `room_ID` = '$room_ID'");
		$del_es_result = $del_es->execute();

		$del_s = $room->runQuery("DELETE FROM  `room_subject`  WHERE  `room_ID` = '$room_ID'");
		$del_s_result = $del_s->execute();

		$statement = $room->runQuery("DELETE FROM `room` WHERE `room_ID` = '$room_ID'");
		$result = $statement->execute();

		if (!empty($result)) {
			echo 'Successfully Deleted';
		}


	}
	if ($_POST["operation"] == "delete_room_student") {
		$room_stud_id = $_POST["room_stud_id"];
		$del_es = $room->runQuery("DELETE FROM `room_enrolled_student` WHERE `res_ID` = '$room_stud_id'");
		$del_es_result = $del_es->execute();


		echo 'Successfully Deleted';
	}
	if ($_POST["operation"] == "delete_room_subject") {
		$room_sub_id = $_POST["room_sub_id"];

		$del_s = $room->runQuery("DELETE FROM `room_subject` WHERE `room_subject`.`rsub_ID` = '$room_sub_id'");
		$del_s_result = $del_s->execute();

		echo 'Successfully Deleted';
	}
}
?>