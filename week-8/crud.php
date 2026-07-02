<?php
    require_once 'database.php';
    /*
        The extends keyword means the 'crud' class inherits all the traits and propeties of the 'database' class. 
    */
    class crud extends database{
        public function __construct(){
            parent::__construct();
        }
        public function getData($query){
            $result = $this->connection->query($query);
            if($result == false){
                return false;
            }
            $rows = array();
            /*
                fetch_assoc() grabs one row of data at a time as an associative array.
            */
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }

        public function execute($query){
            $result = $this->connection->query($query);
            if($result == false){
                echo "Error: Cannot execute the command";
                return false;
            }else{
                return true;
            }
        }
        /*
            Why are we doing this? This function cleans the user input before putting it into the database.
        */
        public function escape_string($value){
            return $this->connection->real_escape_string($value);
        }
    }
?>