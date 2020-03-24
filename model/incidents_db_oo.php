<?php 
class IncidentsDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function createNewIncident($custID, $code, $title, $description) {
        try {
            $query = 'INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUES(?, ?, NOW(), ?, ?)';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $custID);
            $statement->bindValue(2, $code);
            $statement->bindValue(3, $title);
            $statement->bindValue(4, $description);
            $statement->execute();
            $statement->closeCursor();
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }
    
}
?>