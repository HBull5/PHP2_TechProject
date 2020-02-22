<?php 
require('../model/database.php');
require('../model/product_db.php');
require('../model/customer_db.php');
require('../model/registrations_db.php');

$action = filter_input(INPUT_POST, 'action');
session_start();
if(isset($_SESSION['custID'])) {
    if($action != 'logout') {
        include 'product_registration.php';
        exit();
    }
}

switch($action) {
    case 'register':
        $errors = [];
        $email = filter_input(INPUT_POST, 'email');
        if(empty($email)) {
            array_push($errors, '**Email field cannot be empty**');
            $_SESSION['errors'] = $errors;
            header("Location: registration_login.php?error");
        } else {
            $custID = getCustomerID($email);
            if(empty($custID)) {
                array_push($errors, '**Invalid Email Try Again**');
                $_SESSION['errors'] = $errors;
                header("Location: registration_login.php?error");
            } else { 
                $_SESSION['custID'] = $custID;
                $_SESSION['customer'] = getCustomer($custID);
                $registeredProducts = getRegisteredProducts($custID);
                $_SESSION['unregisteredProducts'] = getUnregisteredProducts($registeredProducts);
                include 'product_registration.php';
            }
        }
        break;
    case 'logout':
        unset($_SESSION['custID']);
        unset($_SESSION['customer']);
        unset($_SESSION['unregisteredProducts']);
        header("Location: registration_login.php");
        break;
    case 'complete':
        $custID = filter_input(INPUT_POST, 'custID');
        $productName = filter_input(INPUT_POST, 'productName');
        $code = getProductCode($productName);
        registerProduct($custID, $code);
        header("Location: success.php?code=".$code);
        break;
    default:
        header("Location: registration_login.php");
        break;
};
?>