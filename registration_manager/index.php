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
    $action = 'register';
}

if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=customer");
} else if($_SESSION['validated'] != 'customer') {
    header("Location: ../login/login.php?type=customer");
}

switch($action) {
    case 'register':
        $custID = $_SESSION['loginID']['customerID'];
        $registeredProducts = $registrationsDB->getRegisteredProducts($custID);
        if(!empty($registeredProducts)) {
            $_SESSION['unregisteredProducts'] = $registrationsDB->getUnregisteredProducts($registeredProducts);
        } else {
            $_SESSION['unregisteredProducts'] = $productDB->getAllProductNames();
        }
        $_SESSION['custID'] = $custID;
        $_SESSION['customer'] = $customerDB->getCustomer($custID);
        $registeredProducts = $registrationsDB->getRegisteredProducts($custID);
        if(!empty($registeredProducts)) {
            $_SESSION['unregisteredProducts'] = $registrationsDB->getUnregisteredProducts($registeredProducts);
        } else {
            $_SESSION['unregisteredProducts'] = $productDB->getAllProductNames();
        }
        header("Location: product_registration.php");
        break;
    case 'complete':
        $custID = filter_input(INPUT_POST, 'custID');
        $productName = filter_input(INPUT_POST, 'productName');
        $code = $productDB->getProductCode($productName);
        $registrationsDB->registerProduct($custID, $code);
        header("Location: success.php?code=".$code);
    break;
    case 'logout':
        unset($_SESSION['custID']);
        unset($_SESSION['customer']);
        unset($_SESSION['unregisteredProducts']);
        unset($_SESSION['validated']);
        header("Location: ..");
        break;
};
?>