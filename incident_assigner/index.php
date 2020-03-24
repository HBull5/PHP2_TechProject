<?php 

$action = filter_input(INPUT_POST, 'action');

switch($action) {
    case 'selectTech':
        $incidentID = filter_input(INPUT_POST, 'incidentID');
        session_start();
        $_SESSION['incidentID'] = $incidentID;
        header("Location: select_tech.php");
        break;
    case 'assign':
        $techID = filter_input(INPUT_POST, 'techID');
        session_start();
        $_SESSION['techID'] = $techID;
        header("Location: assign_incident.php");
        break;
    case 'success':
        header("Location: success.php");
        break;
    default:
        header("Location: select_incident.php");
        break;
}

?>