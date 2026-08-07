<?php
    // this is the product class file that handles the CRUD operations for products in the database.
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
        // creates a new product in the database with the provided information.
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
        // returns every product in the database.
        public function getAll(){
            $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }
        // returns a single product's information based on the provided product ID.
        public function getById($id){
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        // updates a product's information in the database based on the provided product ID and new information.
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
        // deletes a product from the database based on the provided product ID.
        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>