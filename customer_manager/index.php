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
    $f = filter_input(INPUT_POST, 'firstName');
    $l = filter_input(INPUT_POST, 'lastName');
    $a = filter_input(INPUT_POST, 'address');
    $c = filter_input(INPUT_POST, 'city');
    $s = filter_input(INPUT_POST, 'state');
    $pC = filter_input(INPUT_POST, 'postalCode');
    $cC = filter_input(INPUT_POST, 'countryCode');
    $ph = filter_input(INPUT_POST, 'phone');
    $e = filter_input(INPUT_POST, 'email');
    $pass = filter_input(INPUT_POST, 'password');

    if(empty($f)) {
        array_push($errors, '**First Name field is empty**');
    } else {
        if((strlen($f)) <= 50) {
            $f = $fName;
        } else {
            array_push($errors, '**First Name exceeds 50 chars**');
        };
    };

    if(empty($l)) {
        array_push($errors, '**Last Name field is empty**');
    } else {
        if((strlen($l)) <= 50) {
            $l = $lName;
        } else {
            array_push($errors, '**Last Name exceeds 50 chars**');
        };
    };

    if(empty($a)) {
        array_push($errors, '**First Name field is empty**');
    } else {
        if((strlen($a)) <= 50) {
            $a = $address;
        } else {
            array_push($errors, '**Address exceeds 50 chars**');
        };
    };

    if(empty($c)) {
        array_push($errors, '**City field is empty**');
    } else {
        if((strlen($c)) <= 50) {
            $c = $city;
        } else {
            array_push($errors, '**City exceeds 50 chars**');
        };
    };

    if(empty($s)) {
        array_push($errors, '**State field is empty**');
    } else {
        if((strlen($s)) <= 50) {
            $s = $state;
        } else {
            array_push($errors, '**State exceeds 50 chars**');
        };
    };

    if(empty($pC)) {
        array_push($errors, '**Postal Code field is empty**');
    } else {
        if((strlen($pC)) <= 20) {
            $pC = $postalCode;
        } else {
            array_push($errors, '**Postal Code exceeds 20 chars**');
        };
    };

    if(empty($cC)) {
        array_push($errors, '**Country Code field is empty**');
    } else {
        if((strlen($cC)) <= 2) {
            $cC = $countryCode;
        } else {
            array_push($errors, '**Country Code exceeds 2 chars**');
        };
    };

    if(empty($ph)) {
        array_push($errors, '**Phone field is empty**');
    } else {
        if((strlen($ph)) <= 20) {
            $ph = $phone;
        } else {
            array_push($errors, '**Phone exceeds 20 chars**');
        };
    };

    if(empty($e)) {
        array_push($errors, '**Email field is empty**');
    } else {
        if((strlen($e)) <= 50) {
            $e = $email;
        } else {
            array_push($errors, '**Email exceeds 50 chars**');
        };
    };

    if(empty($pass)) {
        array_push($errors, '**Password field is empty**');
    } else {
        if((strlen($f)) <= 20) {
            $pass = $password;
        } else {
            array_push($errors, '**Password exceeds 20 chars**');
        };
    };

    
};

?>