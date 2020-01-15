<?php 

function getTechs() {
    global $db;
    $query = 'SELECT * FROM technicians';
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statment->fetchAll();
    $statement->closeCurosr();
    return $technicians;
}

function deleteTech() {

}

function addTech() {
    
}


?>