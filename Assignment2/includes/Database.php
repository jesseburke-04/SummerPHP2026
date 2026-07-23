<?php
    class Database{
        // Replace these fake names with my own values.
        private $host = "172.31.22.43";
        private $db_name = "Jesse200657285";
        private $username = "Jesse200657285";
        private $password = "mN1VnXx5l8";
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
                // Set default fetch mode to associative arrays.
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                // write a comment about this and the above lines.
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>