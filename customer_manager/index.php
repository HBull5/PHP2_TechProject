<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = 'listCustomers';
};

if($action === 'listCustomers') {
    if(filter_has_var(INPUT_POST, 'submitBtn')) {
        $search = filter_input(INPUT_POST, 'search');
        header("Location: customer_list.php?search=".$search);
    } else {
        header("Location: customer_list.php");
    };
};

if($action === 'updateCustomers') {
    $custID = filter_input(INPUT_POST, 'custID');
    $customer = getCustomer($custID);
    session_start();
    $_SESSION['customer'] = $customer;
    header("Location: customer_update.php");
};

if($action === 'update') {
    $errors = [];
    $custID = filter_input(INPUT_POST, 'custID');
    $fName = filter_input(INPUT_POST, 'fName');
    $lName = filter_input(INPUT_POST, 'lName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'zip');
    $countryCode = filter_input(INPUT_POST, 'country');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'pass');

    if(empty($fName)) {
        array_push($errors, '**First Name field is empty**');
    } elseif((strlen($fName)) > 50) {
        array_push($errors, '**First Name exceeds 50 chars**');
    };

    if(empty($lName)) {
        array_push($errors, '**Last Name field is empty**');
    } elseif((strlen($lName)) > 50) {
        array_push($errors, '**Last Name exceeds 50 chars**');
    };

    if(empty($address)) {
        array_push($errors, '**Address Name field is empty**');
    } elseif((strlen($address)) > 50) {
        array_push($errors, '**Address exceeds 50 chars**');
    };

    if(empty($city)) {
        array_push($errors, '**City field is empty**');
    } elseif((strlen($city)) > 50) {
        array_push($errors, '**City exceeds 50 chars**');
    };

    if(empty($state)) {
        array_push($errors, '**State field is empty**');
    } elseif((strlen($state)) > 2) {
        array_push($errors, '**State exceeds 2 chars**');
    };

    if(empty($postalCode)) {
        array_push($errors, '**Postal Code field is empty**');
    } elseif((strlen($postalCode)) > 20) {
        array_push($errors, '**Postal Code exceeds 20 chars**');
    };

    if(empty($countryCode)) {
        array_push($errors, '**Country Code field is empty**');
    } elseif((strlen($countryCode)) > 2) {
        array_push($errors, '**Country Code exceeds 2 chars**');
    };

    if(empty($phone)) {
        array_push($errors, '**Phone field is empty**');
    } elseif(!preg_match("/((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/", $phone)) {
        array_push($errors, '**Phone must be (XXX) XXX-XXXX**');
    };

    if(empty($email)) {
        array_push($errors, '**Email field is empty**');
    } elseif((strlen($email)) > 50) {
        array_push($errors, '**Email exceeds 50 chars**');
    };

    if(empty($password)) {
        array_push($errors, '**Password field is empty**');
    } elseif((strlen($password)) > 20) {
        array_push($errors, '**Password exceeds 20 chars**');
    };

    if(empty($errors)) {
        updateCustomer($custID, $fName, $lName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
        header("Location: customer_list.php?search");
    } else {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: customer_update.php?error");
    };
};
?>