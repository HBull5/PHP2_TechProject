<?php 
class IncidentsDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function createNewIncident() {
        try {
            $query = 'INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUES(:customerID, :productCode, NOW(), :title, :description)';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':customerID', $custID);
            $statement->bindValue(':productCode', $code);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
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