<?php 
require('../model/database__oo.php');
require('../model/technician_db_oo.php');
require('../model/incidents_db_oo.php');
$technicianDB = new TechnicianDB();
$incidentDB = new IncidentsDB();
session_start();

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = 'selectIncident';
}

switch($action) {
    case 'selectIncident':
        $_SESSION['techIDLogin'] = $_SESSION['loginID']['techID'];
        $_SESSION['email'] = $technicianDB->getTechEmail($_SESSION['loginID']['techID']);
        header("Location: select_incident.php");
        break;
    case 'update':
        $incidentID = filter_input(INPUT_POST, 'incidentID');
        $_SESSION['incidentID'] = $incidentID;
        header("Location: updateIncident.php");
        break;
    case 'success':
        $errors = [];
        $date = filter_input(INPUT_POST, 'dateClosed');
        $description = filter_input(INPUT_POST, 'description'); 
        $incidentID = $_SESSION['incidentID'];
        $values = [$date, $description];
        $dateArray = date_parse($date);
        if(!empty($date)) {
            if(empty($dateArray['year']) || empty($dateArray['month']) || empty($dateArray['day'])) {
                array_push($errors, '**Invalid Date**');
            } else {
                $date = explode("-", $date);
                if(strlen($date[0]) < 4) {
                    $date = $dateArray['year'].'-'.$dateArray['day'].'-'.$dateArray['month'];
                } else {
                    $date = $dateArray['year'].'-'.$dateArray['month'].'-'.$dateArray['day'];
                }
            };
        } else {
            $incidentDB->updateIncidentDescription($incidentID, $description);
            header("Location: success.php");
        }
            
        if(empty($errors)) {
            $incidentDB->updateIncident($incidentID, $date, $description);
            header("Location: success.php");
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: updateIncident.php?error");
        };
        break;
    case 'logout':
        unset($_SESSION['techIDLogin']);
        unset($_SESSION['email']);
        header("Location: ../login/login.php?type=tech");
        break;
}
?>