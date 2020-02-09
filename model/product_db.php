<?php 
function getProducts() {
    global $db; 
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
};

function getProductCode($productName) {
    global $db;
    $query = 'SELECT productCode FROM products WHERE name = :name';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $productName);
    $statement->execute();
    $code = $statement->fetchColumn();
    $statement->closeCursor();
    return $code;
};

function getProductName($code) {
    global $db;
    $query = 'SELECT name FROM products WHERE productCode = :productCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':productCode', $code);
    $statement->execute();
    $name = $statement->fetchColumn();
    $statement->closeCursor();
    return $name;
};

function deleteProducts($code) {
    global $db; 
    $query = 'DELETE FROM products
              WHERE productCode =  :productCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':productCode', $code);
    $statement->execute();
    $statement->closeCursor();
};

function addProduct($code, $name, $version, $date) {
    global $db;
    $query = 'INSERT INTO products
              (productCode, name, version, releaseDate)
              VALUES(:code, :name, :version, :releaseDate)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':releaseDate', $date);
    $statement->execute();
    $statement->closeCursor();
};
?>