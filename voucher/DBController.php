<?php
class DBController {

    /*
    $dbhost="c100um.forpsi.com";
        $dbuser="f106443";
        $dbpass="NvSS6EgJ";
        $dbname="f106443";

        $db = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    */

    private $host = "c100um.forpsi.com";
    private $user = "f106443";
    private $password = "NvSS6EgJ";
    private $database = "f106443";
    
     static $conn;
    
    function __construct() {
        $this->conn = $this->connectDB();
        if(!empty($this->conn)) {
            $this->selectDB();
        }
    }
    
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    function selectDB() {
        mysqli_select_db($this->conn, $this->database);
    }

    function numRows($query) {
        $result  = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
    
    function getResult($query) {
        $result  = mysqli_query($this->conn, $query);        
        return $result;
    }
}
?>