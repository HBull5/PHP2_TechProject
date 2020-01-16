<?php

function getCustomers() {

};

function getSearchResults($search) {
    global $db;
    $query = "SELECT * FROM customers WHERE lastName LIKE '%:search%'";
    $statement = $db->prepare($query);
    $statement->bindValue(':search', $search);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
};

function selectCustomer() {

};

// Additional functions for view/update customer go here

?>