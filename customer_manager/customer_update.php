<?php 
    require('../model/database.php');
    require('../model/countries_db.php');
    include '../view/header.php';
    session_start();
    $customer = $_SESSION['customer'];
    $countries = $_SESSION['countries'];
?>
<div id="main">
    <h1>View/Update Customer</h1>
    <div class="error">
    <?php if(filter_has_var(INPUT_GET, 'error')) {
        $errors = $_SESSION['errors'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
    } ?>
    </div>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="custID" value="<?php echo $customer['customerID'] ?>">
        <label>First Name: </label>
        <input type="text" name="fName" value="<?php echo $customer['firstName'] ?>">
        <br>
        <label>Last Name: </label>
        <input type="text" name="lName" value="<?php echo $customer['lastName'] ?>">
        <br>
        <label>Address: </label>
        <input type="text" name="address" value="<?php echo $customer['address'] ?>">
        <br>
        <label>City: </label>
        <input type="text" name="city" value="<?php echo $customer['city'] ?>">
        <br>
        <label>State: </label>
        <input type="text" name="state" value="<?php echo $customer['state'] ?>">
        <br>
        <label>Postal Code: </label>
        <input type="text" name="zip" value="<?php echo $customer['postalCode'] ?>">
        <br>
        <label>Country Code: </label>
        <select name="country">
        <?php foreach($countries as $country) : ?>
        <?php if(getCountryCode($country) == $customer['countryCode']) : ?>
            <option selected value="<?php echo getCountryCode($country) ?>"><?php echo $country ?></option>
        <?php else : ?>
            <option value="<?php echo getCountryCode($country) ?>"><?php echo $country ?></option>
        <?php endif; ?>
        <?php endforeach; ?>
        </select>
        <br>
        <label>Phone: </label>
        <input type="text" name="phone" value="<?php echo $customer['phone'] ?>">
        <br>
        <label>Email: </label>
        <input type="text" name="email" value="<?php echo $customer['email'] ?>">
        <br>
        <label>Password: </label>
        <input type="text" name="pass" value="<?php echo $customer['password'] ?>">
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Update Customer">
        <br>
    </form>
    <p><a href=".">Search Customers</a></p>
</div>
<script src="app.js"></script>
<?php include '../view/footer.php'; ?>