<?php
    /* 
    * Database connection Class
    * Note that this does not run SQL queries...but it acts as a safe highway between PHP and your database.
    */
    class Database {
        private $host;
        private $dbName;
        private $username;
        private $password;
        //this property will hold our actual active connection link once it is created
        private $pdoInstance = null;
        /*
        * The Constructor Method
        * This magic method automatically runs the connection
        */
        public function __construct($host, $dbName, $username, $password) {
            $this->host = $host;
            $this->dbName = $dbName;
            $this->username = $username;
            $this->password = $password;
        }
        public function connect(){
            if($this->pdoInstance !== null){
                return $this->pdoInstance;
            }
            // 1. Create a DSN (Data Source Name) string 
            $dsn = "mysql:host={$this->host}; dbname={$this->dbName}; charset=utf8mb4";
            // 2. Configure PDO options array
            // We configure PDO to change its default behaviors to be safer and easier to work with
            $options = [
                //this settign tells PHP if anything goes wrong with SQL crash with an explicit readable error message.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                //this formats the database rows as objects rather than multi-dimensional arrays.
                //this lets us type out $movie->title instead of $movie['title'] in our HTML view. 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                //disables "emulated" prepares forcing MySQL to natively sanitize our database queries.
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            // 3. The try/catch block
            try {
                $this->pdoInstance = new PDO($dsn, $this->username, $this->password, $options);
                return $this->pdoInstance;
            }catch(PDOException $e){
                die("Database Connection Failed: " . $e->message);
        }
    }
?>