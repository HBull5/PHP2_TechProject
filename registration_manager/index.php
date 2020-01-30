<?php 
require('../model/database.php');
require('../model/product_db.php');
require('../model/customer_db.php');
require('../model/registrations_db.php');

$action = filter_input(INPUT_POST, 'action');
if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
        if(empty($action)) {
            $action = 'login';
        }
};

if($action === 'login') {
    header("Location: registration_login.php");
};

if($action === 'register') {
    $errors = [];
    $email = filter_input(INPUT_POST, 'email');
    if(empty($email)) {
        array_push($errors, '**Email field cannot be empty**');
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: registration_login.php?error");
    } else {
        $custID = getCustomerID($email);
        if(empty($custID)) {
            array_push($errors, '**Invalid Email Try Again**');
            session_start();
            $_SESSION['errors'] = $errors;
            header("Location: registration_login.php?error");
        } else {
            $products = getProducts();
            $customer = getCustomer($custID);
            include 'product_registration.php';
        }
    }
};

if($action === 'complete') {
    $custID = filter_input(INPUT_POST, 'custID');
    $productName = filter_input(INPUT_POST, 'productName');
    $code = getProductCode($productName);
    registerProduct($custID, $code);
    header("Location: success.php?code=".$code);
};
?>