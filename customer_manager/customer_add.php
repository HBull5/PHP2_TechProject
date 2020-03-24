<?php
require('../model/database__oo.php');
require('../model/countries_db_oo.php');
include '../view/header.php';
$countriesDB = new CountryDB();
session_start();
$countries = $_SESSION['countries'];
?>
<div id="main">
<h1>Add/Update Customer</h1>
<?php 
    $error = false;
    if(filter_has_var(INPUT_GET, 'error')) {
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        $error = true; 
    }
?>
<form action="." method="post" id="aligned">
    <input type="hidden" name="action" value="add">
    
    <label>First Name: </label>
    <input type="text" name="fName" value="<?php echo ($error) ? $values[0] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('fName', $errors)) : ?>
            <span class="error"><?php echo $errors['fName'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Last Name: </label>
    <input type="text" name="lName" value="<?php echo ($error) ? $values[1] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('lName', $errors)) : ?>
            <span class="error"><?php echo $errors['lName'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Address: </label>
    <input type="text" name="address" value="<?php echo ($error) ? $values[2] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('address', $errors)) : ?>
            <span class="error"><?php echo $errors['address'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>City: </label>
    <input type="text" name="city" value="<?php echo ($error) ? $values[3] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('city', $errors)) : ?>
            <span class="error"><?php echo $errors['city'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>State: </label>
    <input type="text" name="state" value="<?php echo ($error) ? $values[4] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('state', $errors)) : ?>
            <span class="error"><?php echo $errors['state'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Postal Code: </label>
    <input type="text" name="zip" value="<?php echo ($error) ? $values[5] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('postalCode', $errors)) : ?>
            <span class="error"><?php echo $errors['postalCode'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Country Code: </label>
    <select name="country">
    <?php foreach($countries as $country) : ?>
    <?php if($error) : ?>
        <option selected value="<?php echo $values[6] ?>"><?php echo $countriesDB->getCountryName($values[6]) ?></option>
    <?php endif; ?>
        <option value="<?php echo $countriesDB->getCountryCode($country) ?>"><?php echo $country ?></option>
    <?php endforeach; ?>
    </select>
    <br>

    <label>Phone: </label>
    <input type="text" name="phone" value="<?php echo ($error) ? $values[7] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('phone', $errors)) : ?>
            <span class="error"><?php echo $errors['phone'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Email: </label>
    <input type="text" name="email" value="<?php echo ($error) ? $values[8] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('email', $errors)) : ?>
            <span class="error"><?php echo $errors['email'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>Password: </label>
    <input type="text" name="pass" value="<?php echo ($error) ? $values[9] : '' ?>">
    <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
        <?php if(array_key_exists('password', $errors)) : ?>
            <span class="error"><?php echo $errors['password'] ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <br>

    <label>&nbsp;</label>
    <input type="submit" value="Add Customer">

</form>
    <p><a href=".">Search Customers</a></p>
</div>
<?php include '../view/footer.php' ?>