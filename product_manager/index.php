<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if($action === NULL) {
        $action = 'list_products';
    }
}

if($action === 'list_products') {
    $products = getProducts();
    include './product_list.php';
}

if($action === 'delete') {
    $code = filter_input(INPUT_POST, 'code');
    deleteProducts($code);
    // header reloads the page where include just adds to file
    header("Location: .");
}

if($action === 'showAdd') {
    header("Location: product_add.php");
}

if($action === 'add') {
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $date = filter_input(INPUT_POST, 'date');
    addProduct($code, $name, $version, $date);
    header("Location: .");
}

?>