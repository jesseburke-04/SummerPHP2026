<?php
    class Database{
        private $host = "add your host here";
        private $db_name = "add your database name here";
        private $username = "add your username here";
        private $password = "add your password here";
        public $conn;

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