<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
};

switch($action) {
    case 'delete':
        $code = filter_input(INPUT_POST, 'code');
        deleteProducts($code);
        header("Location: .");
        break;
    case 'showAdd':
        header("Location: product_add.php");
        break;
    case 'add':
        $errors = [];
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version');
        $date = filter_input(INPUT_POST, 'date');
        if(empty($code)) {
            array_push($errors, '**Code field is empty**');
        } elseif((strlen($code)) > 10) {
            array_push($errors, '**Code exceeds 10 chars**');
        };
        if(empty($name)) {
            array_push($errors, '**Name field is empty**');
        } elseif((strlen($name)) > 50) {
            array_push($errors, '**Name exceeds 50 chars**');
        };
        if(empty($version)) {
            array_push($errors, '**Version field is empty**');
        } elseif(!is_numeric(filter_input(INPUT_POST, 'version'))) {
            array_push($errors, '**Version must be numerical**');
        };
        if(empty($date)) {
            array_push($errors, '**Release Date field is empty**');
        } else {
            $date = date_parse($date);
            if(empty($date['year']) || empty($date['month']) || empty($date['day'])) {
                array_push($errors, '**Invalid Date**');
            } else {
                $date = $date['year'] . '/' . $date['month'] .  '/' . $date['day'];
            }
        };
        if(empty($errors)) {
            addProduct($code, $name, $version, $date);
            header("Location: .");
        } else {
            session_start();
            $_SESSION['errors'] = $errors;
            header("Location: product_add.php?error");
        };
        break;
    default: 
        $products = getProducts();
        include './product_list.php';
        break;
};
?>