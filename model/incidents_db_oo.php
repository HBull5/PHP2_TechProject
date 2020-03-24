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

    public function getIncident($incidentID) {
        try {
            $query = 'SELECT * FROM incidents WHERE incidentID = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $incidentID);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function assignIncident($techID, $incidentID) {
        try {
            $query = 'UPDATE incidents SET techID = ? WHERE incidentID = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $techID);
            $statement->bindValue(2, $incidentID);
            $statement->execute();
            $statement->closeCursor();
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getUnassignedIncidents() {
        try {
            $query = "SELECT incidentID, firstName, lastName, productCode, dateOpened, title, description FROM incidents JOIN customers ON incidents.customerID = customers.customerID WHERE incidents.techID IS NULL";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getAssignedIncidents() {
        try {
            $query = "SELECT techID, CONCAT(firstName, ' ', lastName) AS fullName, (SELECT COUNT(techID) FROM incidents WHERE technicians.techID = incidents.techID) AS activeIncidents FROM technicians";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

}
?>