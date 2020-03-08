<?php 
require('../model/database.php');
require('../model/customer_db.php');
require('../model/registrations_db.php');
require('../model/product_db.php');
require('../model/incidents_db.php');

$action = filter_input(INPUT_POST, 'action');

switch($action) {
    // This also is going to need some user input retintion
    case 'createIncident':
        $errors = [];
        $email = filter_input(INPUT_POST, 'email');
        $values = [$email];
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
                $_SESSION['values'] = $values;
                header("Location: get_customer.php?errors");
            } else {
                $customer = getCustomer($custID);
                $registered = getRegisteredProducts($custID);
                include 'create_incident.php';
            }
        };
        break;
    case 'complete':
        $errors = [];
        $custID = filter_input(INPUT_POST, 'custID');
        $code = filter_input(INPUT_POST, 'code');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $values = [$title];

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
            $_SESSION['values'] = $values;
            header("Location: create_incident.php?errors");
        };
        break;
    default:
        header("Location: get_customer.php");
        break;
};
?>