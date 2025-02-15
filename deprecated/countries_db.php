<?php 

function getAllCountryNames() {
    global $db;
    $query = 'SELECT countryName FROM countries';
    $statement = $db->prepare($query);
    $statement->execute();
    $names = $statement->fetchAll(PDO::FETCH_COLUMN);
    $statement->closeCursor();
    return $names;
}

function getCountryCode($countryName) {
    global $db;
    $query = 'SELECT countryCode FROM countries WHERE countryName = :countryName';
    $statement = $db->prepare($query);
    $statement->bindValue(':countryName', $countryName);
    $statement->execute();
    $countryCode = $statement->fetchColumn();
    $statement->closeCursor();
    return $countryCode;
}

function getCountryName($countryCode) {
    global $db;
    $query = 'SELECT countryName FROM countries WHERE countryCode = :countryCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':countryCode', $countryCode);
    $statement->execute();
    $countryName = $statement->fetchColumn();
    $statement->closeCursor();
    return $countryName;
}

?>