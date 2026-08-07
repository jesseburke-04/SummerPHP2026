<?php
    // This is the user class file that handles the user registration, login, and updating of user information.
    class User{
        private $conn;
        private $table = 'users';
        public $id;
        public $username;
        public $email;
        public $password;

        public function __construct($db){
            $this->conn = $db;
        }
        // creates a new account while checking if the email already exist, passwords match, and other validation.
        public function create($username, $email, $password, $confirmPassword){
            if($password !== $confirmPassword){
                throw new Exception("These passwords DON'T match.");
            }
            $checkSql = "SELECT id FROM {$this->table} WHERE email = :email";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->execute([':email' => $email]);
            if($checkStmt->fetch()){
                throw new Exception("An account with that email already exists. Please try again!");
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
        }
        // checks the login credentials against the database and returns the user information if successful.
        public function login($email, $password){
            $sql = "SELECT * FROM {$this->table} WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();
            // I added password_verify, from the internet to check the hashed password against the input password becasue I didn't understand how to do it.
            if($user && password_verify($password, $user['password'])){
                return $user;
            }
            return false;
        }
        // returns all the users information from the database. 
        public function getAll(){
            $sql = "SELECT id, username, email FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }
        // returns a single user's information based on the provided user ID.
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        //updates a users information, while checking if the password is empty or not, and hashing the new password if provided.
        public function update($id, $username, $email, $password = null){
            if(!empty($password)){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE {$this->table} SET username = :username, email = :email, password = :password WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $hashedPassword,
                    ':id' => $id
                ]);
            }else{
                $sql = "UPDATE {$this->table} SET username = :username, email = :email WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':id' => $id
                ]);
            }
        }
        // deletes a user from the database based on the provided user ID.
        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>