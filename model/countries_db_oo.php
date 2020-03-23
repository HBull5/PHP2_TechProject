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
            $query = 'SELECT countryCode FROM countries WHERE countryName = :countryName';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':countryName', $countryName);
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
            $query = 'SELECT countryName FROM countries WHERE countryCode = :countryCode';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':countryCode', $countryCode);
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