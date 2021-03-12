<?php 

    class Database{
        private $servername = "localhost";
        private $db_username = "root";
        private $db_password = "";
        private $database = "tomato_store";
        public $conn;

        //CONSTRUCTOR = a method that is automatically created when an object is created.
        public function __construct()
        {
            $this->conn = new mysqli($this->servername, $this->db_username, $this->db_password, $this->database);

            if($this->conn->connect_error){
                die("Connection Error:".$this->conn->connect_error);
            }

            return $this->conn;

        }
    }

?>