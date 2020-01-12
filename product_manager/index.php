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
    $errors = [];
    $c = filter_input(INPUT_POST, 'code');
    $n = filter_input(INPUT_POST, 'name');
    $v = filter_input(INPUT_POST, 'version');
    $d = filter_input(INPUT_POST, 'date');

    if(empty($c)) {
        array_push($errors, '**Code field is empty**');
    } else {
        if((strlen($c)) <= 10) {
            $code = $c;
        } else {
            array_push($errors, '**Code exceeds 10 chars**');
        };   
    };

    if(empty($n)) {
        array_push($errors, '**Name field is empty**');
    } else {
        if((strlen($n)) <= 50) {
            $name = $n;
        } else {
            array_push($errors, '**Name exceeds 50 chars**');
        };
    };

    // Need to fix the ability to be able to add in periods for decimals
    if(empty($v)) {
        array_push($errors, '**Version field is empty**');
    } else {
        if(is_numeric(filter_input(INPUT_POST, 'version'))) {
            $version = $v;
        } else {
            array_push($errors, '**Version must be numerical**');
        };
    };

    if(empty($d)) {
         array_push($errors, '**Release Date field is empty**');
    } else {
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", filter_input(INPUT_POST, 'date'))) {
            $date = filter_input(INPUT_POST, 'date');
        } else {
            array_push($errors, '**Invalid date format**');
        }; 
    };

    if(!empty($code) && !empty($name) && !empty($version) && !empty($date)) {
        addProduct($code, $name, $version, $date);
        header("Location: .");
    } else {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: product_add.php?error");
    };
};

?>