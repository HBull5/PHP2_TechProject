<?php 

function getProducts() {
    global $db; 
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}

function deleteProducts($code) {
    global $db; 
    $query = 'DELETE FROM products
              WHERE productCode =  :productCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':productCode', $code);
    $statement->execute();
    $statement->closeCursor();
}

function addProduct($code, $name, $version, $date) {
    global $db;
    $query = 'INSERT INTO products
              (productCode, name, version, releaseDate)
              VALUES(:code, :name, :version, :releaseDate)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    // I was unable to use GETDATE() function and it was throwing a fit for some reason why? I took screenshots
    $statement->bindValue(':releaseDate', $date);
    $statement->execute();
    $statement->closeCursor();
}

?>