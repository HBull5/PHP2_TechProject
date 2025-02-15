<?php 
require('../model/database__oo.php');
require('../model/technician_db_oo.php');
require('technician.php');

$action = filter_input(INPUT_POST, 'action');
$techDB = new TechnicianDB();

if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
};

switch($action) {
    case 'delete':
        $techID = filter_input(INPUT_POST, 'technician');
        $techDB->deleteTech($techID);
        header("Location: .");
        break;
    case 'showAdd':
        header("Location: technician_add.php");
        break;
    case 'add':
        $errors = [];
        $fName = filter_input(INPUT_POST, 'fName');
        $lName = filter_input(INPUT_POST, 'lName');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');
        $values = [$fName, $lName, $email, $phone, $password];
        if(empty($fName)) {
            array_push($errors, '**First Name field is empty**');
        } elseif(strlen($fName) > 50) {
            array_push($errors, '**First Name exceeds 50 chars**');
        };
        if(empty($lName)) {
            array_push($errors, '**Last Name field is empty**');
        } elseif(strlen($lName) > 50) {
            array_push($errors, '**Last Name exceeds 50 chars**');
        };
        if(empty($email)) {
            array_push($errors, '**Email field is empty**');
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, '**Invalid Email**');
        };
        if(empty($phone)) {
            array_push($errors, '**Phone field is empty**');
        } elseif(!preg_match("/^[1-9]\d{2}-\d{3}-\d{4}$/", $phone)) {
            array_push($errors, '**Phone must be XXX-XXX-XXXX**');
        };
        if(empty($password)) {
            array_push($errors, '**Password field is empty**');
        } elseif(strlen($password) > 20) {
            array_push($errors, '**Password field exceeds 20 chars**');
        };
        if(empty($errors)) {
            $techDB->addTech($fName, $lName, $email, $phone, $password);
            header("Location: .");
        } else {
            session_start();
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: technician_add.php?error");
        };
        break;
    default:
        $techs = $techDB->getTechs();
        include 'technician_list.php';
        break;
};
?>