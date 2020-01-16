<?php 
require('../model/database.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
    if(empty($action)) {
        $action = 'listTechs';
    }
};

if($action === 'listTechs') {
    $techs = getTechs();
    include 'technician_list.php';
};

if($action === 'delete') {
    $techID = filter_input(INPUT_POST, 'techID');
    deleteTech($techID);
    header('Location: .');
};

if($action === 'showAdd') {
    header("Location: technician_add.php");
};

if($action === 'add') {
    $errors = [];
    $f = filter_input(INPUT_POST, 'fName');
    $l = filter_input(INPUT_POST, 'lName');
    $e = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $ph = filter_input(INPUT_POST, 'phone');
    $pass = filter_input(INPUT_POST, 'password');

    if(empty($f)) {
        array_push($errors, '**First Name field is empty**');
    } else {
        if(strlen($f) <= 50) {
            $fName = $f; 
        } else {
            array_push($errors, '**First Name exceeds 50 chars**');
        };
    };

    if(empty($l)) {
        array_push($errors, '**Last Name field is empty**');
    } else {
        if(strlen($l) <= 50) {
            $lName = $l;
        } else {
            array_push($errors, '**Last Name exceeds 50 chars**');
        };
    };

    if(empty($e)) {
        array_push($errors, '**Email field is empty**');
    } else {
        if(filter_var($e, FILTER_VALIDATE_EMAIL)) {
            $email = $e;
        } else {
            array_push($errors, '**Invalid Email**');
        };
    };

    if(empty($ph)) {
        array_push($errors, '**Phone field is empty**');
    } else {
        if(preg_match("/^[2-9]\d{2}-\d{3}-\d{4}$/", $ph)) {
            $phone = $ph;
        } else {
            array_push($errors, '**Phone must be XXX-XXX-XXXX**');
        };
    };

    if(empty($pass)) {
        array_push($errors, '**Password field is empty**');
    } else {
        if(strlen($pass) <= 20) {
            $password = $pass;
        } else {
            array_push($errors, '**Password field exceeds 20 chars**');
        };
    };

    if(!empty($fName) && !empty($lName) && !empty($email) && !empty($phone) && !empty($password)) {
        addTech($fName, $lName, $email, $phone, $password);
        header("Location: .");
    } else {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: technician_add.php?error");
    };
};

?>