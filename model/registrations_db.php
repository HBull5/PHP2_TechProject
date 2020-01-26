<?php 

function registerProduct($custID, $code) {
    global $db;
    $query = "INSERT INTO registrations VALUES(:customerID, :productCode, NOW())";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $custID);
    $statement->bindValue(':productCode', $code);
    $statement->execute();
    $statement->closeCursor();
}

function getRegisteredProducts($custID) {
    global $db; 
    $query = "SELECT productCode FROM registrations WHERE customerID = :customerID";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $custID);
    $statement->execute();
    $registered = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $registered;
}

function getUnregisteredProducts(array $registeredProducts) {
    global $db;
    $query = "SELECT name FROM products WHERE productCode NOT IN (";
    $len = count($registeredProducts);
    for($i = 0; $i < $len; $i++) {
        if($i !== ($len - 1)) {
            $query .= "'" . $registeredProducts[$i] . "'" . ", ";
        } else {
            $query .= "'" . $registeredProducts[$i] . "'" . ")";
        }
    }
    $statement = $db->prepare($query);
    $statement->execute();
    $unregistered = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $unregistered;
}

?>