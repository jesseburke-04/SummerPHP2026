<?php 
  /**
   * MovieCrud Class
   * This class handles the actual SQL data logic, It DOES NOT know how to 
   * connect to a database
   */
  class MovieCrud{
    // This property will store the database connection
    private $dbConnection;
    /**
     * Dependency injection constructor
     * We are forcing this class to only accept a valid, working instance of the built-in PDO class
     */
    public function __construct(PDO $activePdoConnection){
      $this->dbConnection = $activePdoConnection;
    }
    /**
     * READ Operation (with pagination)
     */
    public function readAllPopular($selectPage = 1){
      // Basic pagination math setup
      $recordsPerPage = 12;
      $offset = ($selectPage - 1) * $recordsPerPage;
      // Prepared statements & named placeholders
      $sqlQuery = "SELECT * FROM lessonMovies ORDER BY popularity DESC LIMIT :limit OFFSET :offset";
      try{
        // 1. Prepare the query template with the database sesrver
        $statement = $this->dbConnection->prepare($sqlQuery);
        // 2. Bind the values to the placeholders
        $statement->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
        // 3. Excute the safe statement on the datbase server
        $statement->excute();
        // 4. Fetch the records
        return $statement->fetchAll();
      }catch(PDOException $e){
        // if an SQL query breaks then return the error to the user
        return [];
      }
    }
  }
?>