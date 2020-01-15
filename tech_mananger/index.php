<?php 
require('../model/database.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
    if(empty($action)) {
        $action = 'listTechs';
    }
}

if($action === 'listTechs') {
    $techs = getTechs();
    include 'technician_list.php';
}

if($action === 'delete') {
    $techID = filter_input(INPUT_POST, 'techID');
    deleteTech($techID);
    header('Location: .');
}

if($action === 'showAdd') {
    header("Location: technician_add.php");
}

?>