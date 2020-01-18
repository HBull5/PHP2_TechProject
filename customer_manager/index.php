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
    $f = filter_input(INPUT_POST, 'fName');
    $l = filter_input(INPUT_POST, 'lName');
    $a = filter_input(INPUT_POST, 'address');
    $c = filter_input(INPUT_POST, 'city');
    $s = filter_input(INPUT_POST, 'state');
    $pC = filter_input(INPUT_POST, 'zip');
    $cC = filter_input(INPUT_POST, 'country');
    $ph = filter_input(INPUT_POST, 'phone');
    $e = filter_input(INPUT_POST, 'email');
    $pass = filter_input(INPUT_POST, 'pass');

    if(empty($f)) {
        array_push($errors, '**First Name field is empty**');
    } else {
        if((strlen($f)) <= 50) {
            $fName = $f;
        } else {
            array_push($errors, '**First Name exceeds 50 chars**');
        };
    };

    if(empty($l)) {
        array_push($errors, '**Last Name field is empty**');
    } else {
        if((strlen($l)) <= 50) {
            $lName = $l;
        } else {
            array_push($errors, '**Last Name exceeds 50 chars**');
        };
    };

    if(empty($a)) {
        array_push($errors, '**Address Name field is empty**');
    } else {
        if((strlen($a)) <= 50) {
            $address = $a;
        } else {
            array_push($errors, '**Address exceeds 50 chars**');
        };
    };

    if(empty($c)) {
        array_push($errors, '**City field is empty**');
    } else {
        if((strlen($c)) <= 50) {
            $city = $c;
        } else {
            array_push($errors, '**City exceeds 50 chars**');
        };
    };

    if(empty($s)) {
        array_push($errors, '**State field is empty**');
    } else {
        if((strlen($s)) <= 50) {
            $state = $s;
        } else {
            array_push($errors, '**State exceeds 50 chars**');
        };
    };

    if(empty($pC)) {
        array_push($errors, '**Postal Code field is empty**');
    } else {
        if((strlen($pC)) <= 20) {
            $postalCode = $pC;
        } else {
            array_push($errors, '**Postal Code exceeds 20 chars**');
        };
    };

    if(empty($cC)) {
        array_push($errors, '**Country Code field is empty**');
    } else {
        if((strlen($cC)) <= 2) {
            $countryCode = $cC;
        } else {
            array_push($errors, '**Country Code exceeds 2 chars**');
        };
    };

    if(empty($ph)) {
        array_push($errors, '**Phone field is empty**');
    } else {
        if((strlen($ph)) <= 20) {
            $phone = $ph;
        } else {
            array_push($errors, '**Phone exceeds 20 chars**');
        };
    };

    if(empty($e)) {
        array_push($errors, '**Email field is empty**');
    } else {
        if((strlen($e)) <= 50) {
            $email = $e;
        } else {
            array_push($errors, '**Email exceeds 50 chars**');
        };
    };

    if(empty($pass)) {
        array_push($errors, '**Password field is empty**');
    } else {
        if((strlen($f)) <= 20) {
            $password = $pass;
        } else {
            array_push($errors, '**Password exceeds 20 chars**');
        };
    };

    if(!empty($fName) && !empty($lName) && !empty($address) && !empty($city) && !empty($state) && !empty($postalCode) && !empty($countryCode) && !empty($phone) && !empty($email) && !empty($password)) {
        updateCustomer($custID, $fName, $lName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
        header("Location: customer_list.php?search=");
    } else {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: customer_update.php?error");
    };


};

?>