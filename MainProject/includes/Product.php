<?php
    class Product{
        private $conn;
        private $table = 'products';
        public $id;
        public $name;
        public $quantity;
        public $description;
        public $price;
        public $image;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create($name, $quantity, $description, $price, $image){
            $sql = "INSERT INTO {$this->table} (name, quantity, description, price, image) VALUES (:name, :quantity, :description, :price, :image)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':quantity' => $quantity,
                ':description' => $description,
                ':price' => $price,
                ':image' => $image
            ]);
        }

        public function getAll(){
            $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }

        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        public function update($id, $name, $quantity, $description, $price){
            $sql = "UPDATE {$this->table} SET name = :name, quantity = :quantity, description = :description, price = :price WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':quantity' => $quantity,
                ':description' => $description,
                ':price' => $price,
                ':id' => $id
            ]);
        }

        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>