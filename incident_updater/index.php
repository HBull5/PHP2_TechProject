<?php 
require('../model/database__oo.php');
require('../model/technician_db_oo.php');
require('../model/incidents_db_oo.php');
$technicianDB = new TechnicianDB();
$incidentDB = new IncidentsDB();
session_start();

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = 'login';
}

switch($action) {
    case 'login':
        if(isset($_SESSION['techIDLogin'])) {
            if($action != 'logout') {
                header("Location: select_incident.php");
            }
        } else {
            header("Location: login.php");
        }
        break;
    case 'selectIncident':
        $errors = [];
        $email = filter_input(INPUT_POST, 'email');
        $values = [$email];
        if(empty($email)) {
            array_push($errors, '**Email field cannot be empty**');
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: login.php?error");
        } else {
            $techID = $technicianDB->getTechID($email);
            if(empty($techID)) {
                array_push($errors, '**Invalid Email Try Again**');
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                header("Location: login.php?error");
            } else {
                $_SESSION['techIDLogin'] = $techID['techID'];
                $_SESSION['email'] = $email;
                header("Location: select_incident.php");
            }
        }
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
        header("Location: login.php");
        break;
}
?>