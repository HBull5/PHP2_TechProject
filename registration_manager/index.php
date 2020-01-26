<?php 
require('../model/database.php');
require('../model/product_db.php');
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
    $products = getProducts();
    include 'product_registration.php';
};

if($action === 'complete') {
    $productName = filter_input(INPUT_POST, 'productName');
    $code = getProductCode($productName);
    echo $code;
}
?>