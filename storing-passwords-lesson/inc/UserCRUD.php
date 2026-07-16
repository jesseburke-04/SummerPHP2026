<?php 
    require_once 'Database.php';
    class UserCRUD{
        private PDO $conn;
        private string $table_name = 'users';
        public function __construct(Database $db){
            $this->conn = $db->connect();
        }
        public function create_user(string $username, string $email, string $hashed_password) :bool{
            $query = "INSERT INTO " . $this->table_name . "(username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            if($stmt->execute()){
                return true;
            }
            // The Failsafe: If something went wrong and MySQL didn't insert the row, we halt the execution and throw an Exception.
            throw new Exception("Something failed inside the UserCRUD Class");
        }
    }
?>