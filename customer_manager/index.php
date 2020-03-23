<?php
// require('../model/database.php');
require('../model/database__oo.php');
// require('../model/customer_db.php');
require('../model/customer_db_oo.php');
require('../model/countries_db_oo.php');

$action = filter_input(INPUT_POST, 'action');
$countriesDB = new CountryDB();
$customerDB = new CustomerDB();

switch($action) {
    case 'updateCustomers':
        $custID = filter_input(INPUT_POST, 'custID');
        $customer = $customerDB->getCustomer($custID);
        $countries = $countriesDB->getAllCountryNames();
        session_start();
        $_SESSION['customer'] = $customer;
        $_SESSION['countries'] = $countries;
        header("Location: customer_update.php");
        break;
    case 'update':
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
        $values = [$fName, $lName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password];

        if(empty($fName)) {
            $errors['fName'] = 'Required';
        } elseif((strlen($fName)) > 50) {
            $errors['fName'] = 'Too long';
        };

        if(empty($lName)) {
            $errors['lName'] = 'Required';
        } elseif((strlen($lName)) > 50) {
            $errors['lName'] = 'Too long';
        };

        if(empty($address)) {
            $errors['address'] = 'Required';
        } elseif((strlen($address)) > 50) {
            $errors['address'] = 'Too long';
        };

        if(empty($city)) {
            $errors['city'] = 'Required';
        } elseif((strlen($city)) > 50) {
            $errors['city'] = 'Too long';
        };

        if(empty($state)) {
            $errors['state'] = 'Required';
        } elseif((strlen($state)) > 2) {
            $errors['state'] = 'Too long';
        };

        if(empty($postalCode)) {
            $errors['postalCode'] = 'Required';
        } elseif((strlen($postalCode)) > 20) {
            $errors['postalCode'] = 'Too long';
        };

        if(empty($phone)) {
            $errors['phone'] = 'Required';
        } elseif(!preg_match("/^([\(]{1}[0-9]{3}[\)]{1}[ ]{1}[0-9]{3}[\-]{1}[0-9]{4})$/", $phone)) {
            $errors['phone'] = 'Use (999) 999-9999 format';
        };

        if(empty($email)) {
            $errors['email'] = 'Required';
        } elseif((strlen($email)) > 50) {
            $errors['email'] = 'Too long';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        } 

        if(empty($password)) {
            $errors['password'] = 'Required';
        } elseif((strlen($password)) > 20) {
            $errors['password'] = 'Too long';
        } elseif(strlen($password) < 6) {
            $errors['password'] = 'Too short';
        }

        if(empty($errors)) {
            $customerDB->updateCustomer($custID, $fName, $lName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
            header("Location: customer_list.php?search");
        } else {
            session_start();
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: customer_update.php?error");
        };
        break; 
    default: 
        if(filter_has_var(INPUT_POST, 'submitBtn')) {
            $search = filter_input(INPUT_POST, 'search');
            header("Location: customer_list.php?search=".$search);
        } else {
            header("Location: customer_list.php");
        };
        break;
};
?>