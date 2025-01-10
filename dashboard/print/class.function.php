<?php 
/**
 * 
 */
require_once('../../dbconfig.php');

class PrntFunction
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

}



?>