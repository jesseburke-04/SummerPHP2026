<?php
    class Database{
        // replaces with my own information
        private $host = "add your host here";
        private $db_name = "your database name here";
        private $username = "your username here";
        private $password = "your password here";
        public $conn;

        /**
        * Establish a database connection using PDO.
        * @return PDO|null
        */
        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4", $this->username, $this->password);
                // Set error mode to Exception so database errors throw catchable errors.
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // set default fetch mode to associative arrays
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                // for production application, log this instead of echoing, but good for student debugging.
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>