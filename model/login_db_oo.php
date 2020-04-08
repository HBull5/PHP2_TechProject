<?php 
class LoginDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function adminLogin($loginID, $password) {
        try {
            $query = "SELECT * FROM administrators WHERE username = ? AND password = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $loginID);
            $statement->bindValue(2, $password);
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

    public function techLogin($loginID, $password) {
        try {
            $query = "SELECT * FROM technicians WHERE email = ? AND password = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $loginID);
            $statement->bindValue(2, $password);
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

    public function customerLogin($loginID, $password) {
        try {
            $query = "SELECT * FROM customers WHERE email = ? AND password = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $loginID);
            $statement->bindValue(2, $password);
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