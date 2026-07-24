// The connection file.
<?php
    class Database{
        // The connection information for mysql and file zilla.
        private $host = "172.31.22.43";
        private $db_name = "Jesse200657285";
        private $username = "Jesse200657285";
        private $password = "mN1VnXx5l8";
        public $conn;
        // Created a function that connect my code to the database.
        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4", $this->username, $this->password);
                // Best practive to send a message if an error occurs.
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Sets the default results to associative arrays as learned in class.
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                // This catches the error if the connection fails..
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>