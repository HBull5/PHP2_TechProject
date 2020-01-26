<?php 

function registerProduct($customerID, $productCode) {
    global $db;
    $query = "INSERT INTO registrations VALUES(:customerID, :productCode, NOW())";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->execute();
    $statement->closeCursor();
}


?>