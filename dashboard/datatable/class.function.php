<?php 
/**
 * 
 */
require_once('../../../dbconfig.php');

class DTFunction
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;

    }
    
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }


    public function get_total_all_records($q)
    {
        try
        { 
            $statement =  $stmt = $this->conn->prepare("$q");
            $statement->execute();
            $result = $statement->fetchAll();

            return $statement->rowCount(); 
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }

    public function check_user_level($var)
    {
        try
        { 
            $statement =  $stmt = $this->conn->prepare("SELECT * FROM `user_level` WHERE `lvl_ID` = $var");
            $statement->execute();
            $result = $statement->fetchAll();

            foreach($result as $row)
            {
                $level_name = $row["lvl_Name"];
            }

            return $level_name; 
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }
     public function insert_subject($subject_title,$Abbreviation){
        try
        { 
            $sql = "INSERT INTO `ref_subject` 
            (`subject_ID`, `subject_Title`,`Abbreviation`) 
            VALUES 
            (NULL, '$subject_title','$Abbreviation');";
            $statement = $this->runQuery($sql);
            $result = $statement->execute();
            
            return $last_id = $this->conn->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }

    public function generate_account($id,$user_type){
        try{
        $user_type_acro = "";

        if ($user_type == "student")
        {
            $user_type_acro = "rsd";
             $sc_id = "rsd_StudNum";
             $slvl = 1;
        }
        if ($user_type == "instructor")
        {
            $user_type_acro = "rid";
            $sc_id = "rid_EmpID";
            $slvl = 2;
        }
        if ($user_type == "admin")
        {
            $user_type_acro = "rad";
            $sc_id = "rad_EmpID";
            $slvl = 3;

        }
            $q1 ="SELECT * FROM `record_".$user_type."_details` WHERE ".$user_type_acro."_ID = '$id'";

            $stmt1 = $this->conn->prepare($q1);
            $stmt1->execute();
            $result1 = $stmt1->fetchAll();
            

            foreach($result1 as $row)
            {
                $lastname = $row[$user_type_acro."_LName"];
                $sc_id = $row[$sc_id];

            }
            $ac_user = $sc_id;
            $ac_pass = strtolower($lastname).'123';


            $n_pass = password_hash($ac_pass, PASSWORD_DEFAULT);

            $q2 ="INSERT INTO `user_account` (`user_ID`, `lvl_ID`, `user_Img`, `user_Name`, `user_Pass`, `user_Registered`) VALUES (NULL, '$slvl', NULL, '$ac_user', '$n_pass', CURRENT_TIMESTAMP);";
            $stmt2 = $this->conn->prepare($q2);
            $stmt2->execute();
            $last_id = $this->conn->lastInsertId();



            $q3  = "UPDATE `record_".$user_type."_details` SET `user_ID` = '$last_id' WHERE `".$user_type_acro."_ID` = '$id'";
            $stmt3 = $this->conn->prepare($q3);
            $r3 = $stmt3->execute();

            if(!empty($r3))
            {
                echo '<div class="text-center"><strong>Username:</strong>'.$ac_user.'<br>';
                echo '<strong>Password:</strong>'.$ac_pass.'<br>';
                echo 'Account Successfully Created</div>';
            }
            

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 

    }

    public function insert_attendance($room_ID,$stud_ID,$clicked_day,$attnd_stat){
        try
        { 
            $sql = "INSERT INTO `room_student_attendance` 
                (`attendance_ID`,
                `room_ID`,
                 `res_ID`,
                  `attendance_Time`,
                   `attendance_Status`) 
                   VALUES (
                   NULL,
                   '$room_ID',
                    '$stud_ID',
                     '$clicked_day', '$attnd_stat');";
            $statement = $this->runQuery($sql);
            $result = $statement->execute();
            
            return $result;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }

    public function update_attendance($room_ID,$ndate,$res_ID,$stat){
        try
        { 
            $sql = " UPDATE `room_student_attendance` SET `attendance_Status` = '$stat' WHERE  room_ID =  '$room_ID' AND res_ID = '$res_ID' AND attendance_Time LIKE '$ndate%' ";
            $statement = $this->runQuery($sql);
            $result = $statement->execute();
            
            return $result;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }

   

    public function get_active_sem()
    {
        
        $query ="SELECT *,CONCAT(YEAR(sem_start),' - ',YEAR(sem_end)) sem_year FROM `ref_semester` WHERE stat_ID = 1 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }

    public function get_student_by_lrn($admission_StudNum)
    {

        
        $query ="SELECT * FROM `record_student_details`  WHERE rsd_StudNum = $admission_StudNum LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }


}



?>