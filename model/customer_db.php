<?php

function getSearchResults($search) {
    global $db;
    $query = "SELECT * FROM customers WHERE lastName LIKE CONCAT('%', :search, '%')";
    $statement = $db->prepare($query);
    $statement->bindValue(':search', $search);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
};

function getCustomer($custID) {
    global $db;
    $query = "SELECT * FROM customers WHERE customerID = :custID";
    $statement = $db->prepare($query);
    $statement->bindValue(':custID', $custID);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
};

// function updateCustomer($fName, $lName, $address, $city, $state, $zip, $country, $phone, $email, $pass) {
//     global $db;
//     $query = ""
// };

?>