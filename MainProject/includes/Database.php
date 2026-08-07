<?php
    // This is the Database class file that handles the PDO connection to MySQL.
    class Database{
        private $host = "172.31.22.43";
        private $db_name = "Jesse200657285";
        private $username = "Jesse200657285";
        private $password = "mN1VnXx5l8";
        public $conn;
        // This function connects to the database using PDO and returns the connection object.
        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>