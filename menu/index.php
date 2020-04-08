<?php 
session_start();
$loginID = $_SESSION['loginID'];
if(array_key_exists('username', $loginID)) {
    $menuType = 'admin';
} else if(array_key_exists('techID', $loginID)) {
    $menuType = 'tech';
} else if(array_key_exists('customerID', $loginID)) {
    $menuType = 'customer';
}

switch($menuType) {
    case 'admin':
        header("Location: adminMenu.php");
        break;
    case 'tech':
        header("Location: ../incident_updater");
        break;
    case 'customer':
        header("Location: ../registration_manager");
        break;
}
?>