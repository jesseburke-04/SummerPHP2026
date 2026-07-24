// This file handles the database information in the orders.
<?php
    class PizzaOrder{
        private $conn;
        private $table = 'pizza_orders';
        public $id;
        public $name;
        public $email;
        public $phone;
        public $address;
        public $size;
        public $crust;
        public $toppings;
        public $deliveryMethod;

        // Used a constructor to recieve the database connection.
        public function __construct($db){
            $this->conn = $db;
        }
        // Used the create function to receive the informatino from the pizza orders and put it into the database.
        public function create($name, $email, $phone, $address, $size, $crust, $toppings, $deliveryMethod){
            $sql = "INSERT INTO {$this->table} (name, email, phone, address, size, crust, toppings, delivery_method)
                    VALUES (:name, :email, :phone, :address, :size, :crust, :toppings, :delivery_method)";
            // This prevents SQL injection attacks (common practice).
            $stmt = $this->conn->prepare($sql);
            // This runs the SQL command and send the actual values. 
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
                ':size' => $size,
                ':crust' => $crust,
                ':toppings' => $toppings,
                ':delivery_method' => $deliveryMethod
            ]);
        }
    }
?>