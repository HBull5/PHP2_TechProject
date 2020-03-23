<?php 
class RegistrationsDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function registerProduct($custID, $code) {
        try {
            $query = "INSERT INTO registrations VALUES(:customerID, :productCode, NOW())";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':customerID', $custID);
            $statement->bindValue(':productCode', $code);
            $statement->execute();
            $statement->closeCursor();
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getRegisteredProducts($custID) {
        try {
            $query = "SELECT productCode FROM registrations WHERE customerID = :customerID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':customerID', $custID);
            $statement->execute();
            $registered = $statement->fetchAll(PDO::FETCH_COLUMN);
            $statement->closeCursor();
            return $registered;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getUnregisteredProducts(array $registeredProducts) {
        try {
            $query = "SELECT name FROM products WHERE productCode NOT IN (";
            $len = count($registeredProducts);
            for($i = 0; $i < $len; $i++) {
                if($i !== ($len - 1)) {
                    $query .= "'" . $registeredProducts[$i] . "'" . ", ";
                } else {
                    $query .= "'" . $registeredProducts[$i] . "'" . ")";
                }
            }
            $statement = $this->db->prepare($query);
            $statement->execute();
            $unregistered = $statement->fetchAll(PDO::FETCH_COLUMN);
            $statement->closeCursor();
            return $unregistered;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

}
?>