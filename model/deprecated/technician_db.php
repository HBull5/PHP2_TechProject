<?php 
function getTechs() {
    global $db;
    $query = 'SELECT * FROM technicians';
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    $statement->closeCursor();
    return $technicians;
};

function deleteTech($techID) {
    global $db;
    $query = 'DELETE FROM technicians WHERE techID = :techID';
    $statement = $db->prepare($query);
    $statement->bindValue(':techID', $techID);
    $statement->execute();
    $statement->closeCursor();
};

function addTech($fName, $lName, $email, $phone, $pass) {
    global $db;
    $query = 'INSERT INTO technicians (firstName, lastName, email, phone, `password`)
              VALUES (:fName, :lName, :email, :phone, :pass)';
    $statement = $db->prepare($query);
    $statement->bindValue(':fName', $fName);
    $statement->bindValue(':lName', $lName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':pass', $pass);
    $statement->execute();
    $statement->closeCursor();
};
?>