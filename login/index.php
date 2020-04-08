<?php 
require('../model/database__oo.php');
require('../model/login_db_oo.php');
session_start();

$action = filter_input(INPUT_POST, 'action');
$type = filter_input(INPUT_GET, 'type');
$loginDB = new LoginDB();

switch($action) {
    case 'login':
        $errors = [];
        $loginID = filter_input(INPUT_POST, 'loginID');
        $password = filter_input(INPUT_POST, 'password');
        $values = [$loginID, $password];

        if(empty($loginID)) {
            array_push($errors, ($type === 'admin') ? 'Username cannot be empty!' : 'Email cannot be empty!');
        } 
        if(empty($password)) {
            array_push($errors, 'Password cannot be empty!');
        }

        if(empty($errors)) {
            $results; 
            if($type === 'admin') {
                $results = $loginDB->adminLogin($loginID, $password);
            } else if($type === 'tech') {
                $results = $loginDB->techLogin($loginID, $password);
            } else if($type === 'customer') {
                $results = $loginDB->customerLogin($loginID, $password);
            }
            if(empty($results)) {
                array_push($errors, 'Invalid Credintials! Try Again!');
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                header("Location: login.php?error&type=".$type);
            } else {
                echo 'successful login!!!!';
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            header("Location: login.php?error&type=".$type);
        }
        break;
    default:
        include 'login.php';
        break;
}
?>