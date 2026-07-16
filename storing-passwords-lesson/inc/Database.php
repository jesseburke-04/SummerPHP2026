<?php 
    class Database{
        private string $host = 'your hosting information';
        private string $db_name = 'your database name';
        private string $username = 'your username';
        private string $password = 'your password';

        // the ?PDO means it can either hold a real PDO connection object or be null
        private ?PDO $conn = null;
        public function connect(){
            if($this->conn !== null){
                return $this->conn;
            }
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }
    }
?>