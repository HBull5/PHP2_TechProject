<?php 
class CustomerDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getSearchResults($search) {
        try {
            $query = "SELECT * FROM customers WHERE lastName LIKE CONCAT('%', :search, '%')";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':search', $search);
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
            $query = "SELECT * FROM customers WHERE customerID = :custID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':custID', $custID);
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
            $query = "SELECT customerID FROM customers WHERE email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':email', $email);
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
            $query = "UPDATE customers SET firstName = :fName, lastName = :lName, `address` = :address, city = :city, `state` = :state, postalCode = :zip, countryCode = :country, phone = :phone, email = :email, `password` = :pass WHERE customerID = :custID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':custID', $custID);
            $statement->bindValue(':fName', $fName);
            $statement->bindValue(':lName', $lName);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':zip', $zip);
            $statement->bindValue(':country', $country);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':pass', $pass);
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