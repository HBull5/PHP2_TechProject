<?php 
require('../model/database.php');
require('../model/customer_db.php');
require('../model/registrations_db.php');
require('../model/product_db.php');
require('../model/incidents_db.php');

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
    if(empty($action)) {
        $action = 'getCustomer';
    };
};

if($action === 'getCustomer') {
    header("Location: get_customer.php");
};

if($action === 'createIncident') {
    $errors = [];
    $email = filter_input(INPUT_POST, 'email');
    if(empty($email)) {
        array_push($errors, '**Email field cannot be empty**');
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: get_customer.php?errors");
    } else {
        $custID = getCustomerID($email);
        if(empty($custID)) {
            array_push($errors, '**Email is invalid. Please Try again!**');
            session_start();
            $_SESSION['errors'] = $errors;
            header("Location: get_customer.php?errors");
        } else {
            $customer = getCustomer($custID);
            $registered = getRegisteredProducts($custID);
            include 'create_incident.php';
        }
    };
};

if($action === 'complete') {
    $errors = [];
    $custID = filter_input(INPUT_POST, 'custID');
    $code = filter_input(INPUT_POST, 'code');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');

    if(empty($code)) {
        array_push($errors, '**You must register you product to file an incident**');
    };

    if(empty($title)) {
        array_push($errors, '**Title field cannot be empty**');
    } elseif((strlen($title)) > 50) {
        array_push($errors, '**Title field cannot exceed 50 chars**');
    };

    if(empty($description)) {
        array_push($errors, '**Description field cannot be empty**');
    } elseif((strlen($description)) > 2000) {
        array_push($errors, '**Description field cannot exceed 2000 chars**');
    };

    if(empty($errors)) {
        createNewIncident($custID, $code, $title, $description);
        header("Location: success.php");
    } else {
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['custID'] = $custID;
        $_SESSION['customer'] = getCustomer($custID);
        $_SESSION['registered'] = getRegisteredProducts($custID);
        header("Location: create_incident.php?errors");
    };
};
?>