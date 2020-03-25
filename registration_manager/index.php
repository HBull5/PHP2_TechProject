<?php 
require('../model/database__oo.php');
require('../model/product_db_oo.php');
require('../model/customer_db_oo.php');
require('../model/registrations_db_oo.php');

$action = filter_input(INPUT_POST, 'action');
$customerDB = new CustomerDB();
$productDB = new ProductDB();
$registrationsDB = new RegistrationsDB();
session_start();

if(empty($action)) {
    $action = 'login';
}

switch($action) {
    case 'login':
        if(isset($_SESSION['custID'])) {
            if($action != 'logout') {
                echo 'HERE...';
                $registeredProducts = $registrationsDB->getRegisteredProducts($_SESSION['custID']);
                if(!empty($registeredProducts)) {
                    $_SESSION['unregisteredProducts'] = $registrationsDB->getUnregisteredProducts($registeredProducts);
                } else {
                    $_SESSION['unregisteredProducts'] = $productDB->getAllProductNames();
                }
                header("Location: product_registration.php");
            }
        } else {
            header("Location: registration_login.php");
        }
        break;
    case 'register':
        $errors = [];
        $email = filter_input(INPUT_POST, 'email');
        $values = [$email];
        if(empty($email)) {
            array_push($errors, '**Email field cannot be empty**');
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: registration_login.php?error");
        } else {
            $custID = $customerDB->getCustomerID($email);
            if(empty($custID)) {
                array_push($errors, '**Invalid Email Try Again**');
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                header("Location: registration_login.php?error");
            } else { 
                $_SESSION['custID'] = $custID;
                $_SESSION['customer'] = $customerDB->getCustomer($custID);
                $registeredProducts = $registrationsDB->getRegisteredProducts($custID);
                if(!empty($registeredProducts)) {
                    $_SESSION['unregisteredProducts'] = $registrationsDB->getUnregisteredProducts($registeredProducts);
                } else {
                    $_SESSION['unregisteredProducts'] = $productDB->getAllProductNames();
                }
                header("Location: product_registration.php");
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
        $code = $productDB->getProductCode($productName);
        $registrationsDB->registerProduct($custID, $code);
        header("Location: success.php?code=".$code);
    break;
};
?>