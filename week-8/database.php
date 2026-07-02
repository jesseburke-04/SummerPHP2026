<?php
    class database{
        // replace these values with your informatiom from the PHP email
        private $host = 'yourhost';
        private $username = 'yourUsername';
        private $password = 'yourPassword';
        private $database = 'yourDatabaseName';
        protected $conncetion;

        /*
           Constrcutor Method
        */
        public function __construct(){
            if(!isset($this->connection)){
                $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
                if(!$this->connection){
                    echo '<p> Could not connect to the database</p>';
                    exit;
                }
            }
        return $this->connection;
    }
?>