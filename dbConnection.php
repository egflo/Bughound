<?php

class Database {

    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = mysqli_connect("10.81.1.123","admin","1225","bughound","3306");
        
        // Check connection
	    if (mysqli_connect_errno()) {
		    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		    exit();
	    }   
    }
    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}
?>