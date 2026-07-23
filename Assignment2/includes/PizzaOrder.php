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

        /*
          Constructor accepts the active PDO connection object.
        */
        public function __construct($db){
            $this->conn = $db;
        }

        /*
          Create a new table with the pizza order values as placeholders.
        */
        public function create($name, $email, $phone, $address, $size, $crust, $toppings, $deliveryMethod){
            $sql = "INSERT INTO {$this->table} (name, email, phone, address, size, crust, toppings, delivery_method)
                    VALUES (:name, :email, :phone, :address, :size, :crust, :toppings, :delivery_method)";
            $stmt = $this->conn->prepare($sql);
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