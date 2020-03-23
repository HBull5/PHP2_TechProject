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
            $query = 'SELECT productCode FROM products WHERE name = :name';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':name', $productName);
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
            $query = 'SELECT name FROM products WHERE productCode = :productCode';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':productCode', $code);
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

    public function deleteProducts($code) {
        try {
            $query = 'DELETE FROM products
                    WHERE productCode =  :productCode';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':productCode', $code);
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
                    VALUES(:code, :name, :version, DATE_FORMAT(:releaseDate, "%Y-%m-%d"))';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':code', $code);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':releaseDate', $date);
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