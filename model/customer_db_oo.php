<?php 
class CustomerDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getSearchResults($search) {
        try {
            $query = "SELECT * FROM customers WHERE lastName LIKE CONCAT('%', ?, '%')";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $search);
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

    public function getCustomer($custID) {
        try {
            $query = "SELECT * FROM customers WHERE customerID = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $custID);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            return $results;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getCustomerID($email) {
        try {
            $query = "SELECT customerID FROM customers WHERE email = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $email);
            $statement->execute();
            $custID = $statement->fetchColumn();
            $statement->closeCursor();
            return $custID;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function updateCustomer($custID, $fName, $lName, $address, $city, $state, $zip, $country, $phone, $email, $pass) {
        try {
            $query = "UPDATE customers SET firstName = ?, lastName = ?, `address` = ?, city = ?, `state` = ?, postalCode = ?, countryCode = ?, phone = ?, email = ?, `password` = ? WHERE customerID = ?";
            $statement = $this->db->prepare($query);
            $statement->bindValue(11, $custID);
            $statement->bindValue(1, $fName);
            $statement->bindValue(2, $lName);
            $statement->bindValue(3, $address);
            $statement->bindValue(4, $city);
            $statement->bindValue(5, $state);
            $statement->bindValue(6, $zip);
            $statement->bindValue(7, $country);
            $statement->bindValue(8, $phone);
            $statement->bindValue(9, $email);
            $statement->bindValue(10, $pass);
            $statement->execute();
            $statement->closeCursor();
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function addCustomer($fName, $lName, $address, $city, $state, $zip, $country, $phone, $email, $pass) {
        try {
            $query = "INSERT INTO customers (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $fName);
            $statement->bindValue(2, $lName);
            $statement->bindValue(3, $address);
            $statement->bindValue(4, $city);
            $statement->bindValue(5, $state);
            $statement->bindValue(6, $zip);
            $statement->bindValue(7, $country);
            $statement->bindValue(8, $phone);
            $statement->bindValue(9, $email);
            $statement->bindValue(10, $pass);
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