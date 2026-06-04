<?php
// BookRepository.php
class BookRepository {
    private $db;

    // Dependency injection of our working PDO connection
    public function __construct(PDO $pdoConnection) {
        $this->db = $pdoConnection;
    }

    public function getBooksByGenre($genreName) {
        // LAB TASK #3: This SQL string has a security and syntax vulnerability. 
        // Convert the raw variable injection into a secure named placeholder
        $sql = "SELECT * FROM books WHERE genre = :genreName ORDER BY title ASC";

        try {
            $stmt = $this->db->prepare($sql);

            // LAB TASK #4: Write the missing line of code below to securely bind 
            // your named placeholder to the incoming method argument before execution.
            // [Your code here]]
            $stmt->bindValue(':genreName', $genreName, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}