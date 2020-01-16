<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');

if(empty($action)) {
    $action = 'listCustomers';
};

if($action === 'listCustomers') {
    // conditonal check for search btn being pushed 
    if(filter_has_var(INPUT_POST, 'submitBtn')) {
        $search = filter_input(INPUT_POST, 'search');
        header("Location: customer_list.php?search=".$search);
    } else {
        header("Location: customer_list.php");
    }
};




?>