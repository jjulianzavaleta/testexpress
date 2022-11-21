<?php
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "triage";
    private $username = "root";
    private $password;
    public $conn;

    public function __construct()
    {
        if ($_SERVER['SERVER_NAME'] == "localhost")
        {
             $this->password = "";       
        }
        else
        {
             $this->password = "Sis011201";
        } 
    }
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        $this->conn->set_charset("utf8");
        return $this->conn;
    }
}
?>