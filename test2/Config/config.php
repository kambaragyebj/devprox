<?php

/*
* Mysql database class - only one connection allowed
*/
class config {
    private $_connection;
    private static $_instance; //The single instance
    private $_host = "127.0.0.1";
    private $_username = "root";
    private $_password = "aporose";
    private $_database = "devprox";
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username, 
            $this->_password, $this->_database);
    
        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                 E_USER_ERROR);
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }

    public function createRecordTable(){

       $sql = "CREATE TABLE IF NOT EXISTS `Csv_import` (
              `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(50) NOT NULL,
              `initial_name` varchar(10) NOT NULL,
              `age` varchar(10) NOT NULL,
              `date_birth` DATE NOT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            ";
       if ($this->getConnection()->query($sql) === TRUE) {
            //echo "Table Csv_import created successfully";
        } else {
            //echo "Error creating table: " . $this->_connection->error;
        }     

    }

    public function createCustomerTable(){

       $sql = "CREATE TABLE IF NOT EXISTS `customer` (
              `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(50) NOT NULL,
              `id_number` varchar(13) NOT NULL,
              `date_of_birth` DATE NOT NULL,
               UNIQUE KEY `id_num` (`id_number`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            ";
       if ($this->getConnection()->query($sql) === TRUE) {
            //echo "Table Customer created successfully";
        } else {
            //echo "Error creating table: " . $this->_connection->error;
        }     

    }
}
?>