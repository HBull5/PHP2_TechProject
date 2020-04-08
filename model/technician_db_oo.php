<?php 
class TechnicianDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getTechs() {
        try {
            $query = 'SELECT * FROM technicians';
            $statement = $this->db->prepare($query);
            $statement->execute();
            $technicians = $statement->fetchAll();
            $statement->closeCursor();
            return $technicians;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getTechName($techID) {
        try {
            $query = 'SELECT CONCAT(firstName, " ", lastName) FROM technicians WHERE techID = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $techID);
            $statement->execute();
            $techName = $statement->fetch();
            $statement->closeCursor();
            return $techName;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getTechEmail($techID) {
        try {
            $query= "SELECT email FROM technicians WHERE techID = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $techID);
            $statement->execute();
            $techEmail = $statement->fetch(PDO::FETCH_COLUMN);
            $statement->closeCursor();
            return $techEmail;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getTechID($email) {
        try {
            $query = 'SELECT techID FROM technicians WHERE email = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $email);
            $statement->execute();
            $techID = $statement->fetch();
            $statement->closeCursor();
            return $techID;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function deleteTech($techID) {
        $query = 'DELETE FROM technicians WHERE techID = ?';
        $statement = $this->db->prepare($query);
        $statement->bindValue(1, $techID);
        $statement->execute();
        $statement->closeCursor();
    }

    public function addTech($fName, $lName, $email, $phone, $pass) {
        $query = 'INSERT INTO technicians (firstName, lastName, email, phone, `password`)
                  VALUES (?, ?, ?, ?, ?)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(1, $fName);
        $statement->bindValue(2, $lName);
        $statement->bindValue(3, $email);
        $statement->bindValue(4, $phone);
        $statement->bindValue(5, $pass);
        $statement->execute();
        $statement->closeCursor();
    }

}
?>