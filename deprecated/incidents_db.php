<?php 
function createNewIncident($custID, $code, $title, $description) {
    global $db;
    $query = 'INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUES(:customerID, :productCode, NOW(), :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $custID);
    $statement->bindValue(':productCode', $code);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
};
?>