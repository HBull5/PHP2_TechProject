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
    $results = $statement->fetch();
    $statement->closeCursor();
    return $results;
};

function getCustomerID($email) {
    global $db;
    $query = "SELECT customerID FROM customers WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $custID = $statement->fetchColumn();
    $statement->closeCursor();
    return $custID;
}

function updateCustomer($custID, $fName, $lName, $address, $city, $state, $zip, $country, $phone, $email, $pass) {
    global $db;
    $query = "UPDATE customers SET firstName = :fName, lastName = :lName, `address` = :address, city = :city, `state` = :state, postalCode = :zip, countryCode = :country, phone = :phone, email = :email, `password` = :pass WHERE customerID = :custID";
    $statement = $db->prepare($query);
    $statement->bindValue(':custID', $custID);
    $statement->bindValue(':fName', $fName);
    $statement->bindValue(':lName', $lName);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->bindValue(':country', $country);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':pass', $pass);
    $statement->execute();
    $statement->closeCursor();
};
?>