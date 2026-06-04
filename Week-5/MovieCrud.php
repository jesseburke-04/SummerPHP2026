<?php
    /*
    * Movie Crud Class
    * This class handles the actual SQL data logic, IT DOES NOT know hot to connect to a database
    */
    class MovieCrud{
        //this property wil store the database connection
        private $dbConnection;
        /*
        * Dependency injection constructor 
        * We re forcing this class ton only accept a valid, working instance of the built-in
        * PDO class. 
        */
        public function __construct(PDO $activePdoConnection){
            $this->dbConnection = $activePdoConnection;
        }
        /*
        * Read Operation (with pagination)
        */
        public function readAllPopular($selectPage = 1){
            //Basic pagination math setup
            $recordsPerPage = 12;
            $offset = ($selectPage - 1) * $recordsPerPage;
            // Prepared statements & named placeholders
            $sqlQuery = "SELECT * FROM lessonMovies ORDER BY popularity DESC LIMIT :limit OFFSET :offset";
            try{
                // 1. Prepare the query template with the database server
                $statement = $this->dbConnection->prepare($sqlQuery);
                // 2. Bind the values to the placeholders in the template
                $statement->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
                // 3. Execute the safe statement on the database server
                $statement->execute();
                // 4. Fetch the records
                return $statement->fetchAll();
            }catch(PDOException $e){
                // if an SQL query breaks then return the error to the user
                return[];
            }
        }
    }
?>