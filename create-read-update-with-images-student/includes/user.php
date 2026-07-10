<?php
    class User{
        private $conn;
        private $table = 'userRecords';
        public $id;
        public $name;
        public $email;
        public $image;

        /*
            Constructor accepts the active PDO connectino object.
        */
        public function __construct($db){
            $this->conn = $db;
        }

        /*
            Create a new user record using named placeholders.
        */
        public function create($name, $email, $image){
            $sql = "INSERT INTO {$this->table} {name, email, image} VALUES {:name, :email, :image}";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':image' => $image
            ]);
        }
        /*
            Read all users ordered by newest first
        */
        public function getAll(){
            $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }
        /*
            Read a specific user profile by ID
        */
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(); //this return an associative array, or false if not found.
        }
        /*
            Update user details and dynamically manage image value changes.
        */
        public function update($id, $name, $email, $image = null){
            $sql = "UPDATE {$this->table} SET name = :name, email = :email, image = :image WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':image' => $image,
                ':id' => $id
            ]);
        }
        /*
            Delete a user profile from the database.
        */
        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>