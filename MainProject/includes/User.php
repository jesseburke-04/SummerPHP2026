<?php
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

        public function create($username, $email, $password, $confirmPassword){
            if($password !== $confirmPassword){
                throw new Exception("Passwords do not match.");
            }
            $checkSql = "SELECT id FROM {$this->table} WHERE email = :email";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->execute([':email' => $email]);
            if($checkStmt->fetch()){
                throw new Exception("An account with that email already exists.");
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

        public function login($email, $password){
            $sql = "SELECT * FROM {$this->table} WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();
            if($user && password_verify($password, $user['password'])){
                return $user;
            }
            return false;
        }

        public function getAll(){
            $sql = "SELECT id, username, email FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }

        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

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

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>