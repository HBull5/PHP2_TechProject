<?php 
class CountryDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getAllCountryNames() {
        try {
            $query = 'SELECT countryName FROM countries';
            $statement = $this->db->prepare($query);
            $statement->execute();
            $names = $statement->fetchAll(PDO::FETCH_COLUMN);
            $statement->closeCursor();
            return $names;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getCountryCode($countryName) {
        try {
            $query = 'SELECT countryCode FROM countries WHERE countryName = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $countryName);
            $statement->execute();
            $countryCode = $statement->fetchColumn();
            $statement->closeCursor();
            return $countryCode;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    } 

    public function getCountryName($countryCode) {
        try {
            $query = 'SELECT countryName FROM countries WHERE countryCode = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $countryCode);
            $statement->execute();
            $countryName = $statement->fetchColumn();
            $statement->closeCursor();
            return $countryName;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }
    
}
?>