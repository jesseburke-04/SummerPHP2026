<?php
// db_config.php
/define the address where the database server lives
    define("DB_HOST", "172.31.22.43");
    //define the name of the database that we will be using
    define("DB_NAME", "Jesse200657285"); //replace with your info
    //define the username for your database
    define("DB_USER", "Jesse200657285"); //replace with your info
    //define the password for the user
    define("DB_PASSWORD", "mN1VnXx5l8"); //replace with your info

class BookDatabase {
    private $host = DB_HOST;
    private $db   = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $pdoInstance = null;

    public function getConnection() {
        if ($this->pdoInstance !== null) {
            return $this->pdoInstance;
        }

        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // LAB TASK #1: Review the fetch mode configuration below. 
            // Does it match how index.php expects to read the data?
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
        ];

        try {
            // LAB TASK #2: There is a critical syntax error on the line below 
            // preventing the PDO instance from initializing. Fix it.
            $this->pdoInstance = new PDO($dsn, $this->user, $this->pass, $options);
            return $this->pdoInstance;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}