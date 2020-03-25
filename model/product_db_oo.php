<?php 
class ProductDB {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getDB();
    }

    public function getProducts() {
        try {
            $query = 'SELECT * FROM products';
            $statement = $this->db->prepare($query);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getProductCode($productName) {
        try {
            $query = 'SELECT productCode FROM products WHERE name = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $productName);
            $statement->execute();
            $code = $statement->fetchColumn();
            $statement->closeCursor();
            return $code;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getProductName($code) {
        try {
            $query = 'SELECT name FROM products WHERE productCode = ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $code);
            $statement->execute();
            $name = $statement->fetchColumn();
            $statement->closeCursor();
            return $name;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getAllProductNames() {
        try {
            $query = 'SELECT name FROM products';
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

    public function deleteProducts($code) {
        try {
            $query = 'DELETE FROM products
                    WHERE productCode =  ?';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $code);
            $statement->execute();
            $statement->closeCursor();
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function addProduct($code, $name, $version, $date) {
        try {
            $query = 'INSERT INTO products
                    (productCode, name, version, releaseDate)
                    VALUES(?, ?, ?, DATE_FORMAT(?, "%Y-%m-%d"))';
            $statement = $this->db->prepare($query);
            $statement->bindValue(1, $code);
            $statement->bindValue(2, $name);
            $statement->bindValue(3, $version);
            $statement->bindValue(4, $date);
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