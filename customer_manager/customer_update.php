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
    <?php 
        if(filter_has_var(INPUT_GET, 'error')) {
            $errors = $_SESSION['errors'];
        }
    ?>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="custID" value="<?php echo $customer['customerID'] ?>">

        <label>First Name: </label>
        <input type="text" name="fName" value="<?php echo $customer['firstName'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('fName', $errors)) : ?>
                <span class="error"><?php echo $errors['fName'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>Last Name: </label>
        <input type="text" name="lName" value="<?php echo $customer['lastName'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('lName', $errors)) : ?>
                <span class="error"><?php echo $errors['lName'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>Address: </label>
        <input type="text" name="address" value="<?php echo $customer['address'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('address', $errors)) : ?>
                <span class="error"><?php echo $errors['address'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>City: </label>
        <input type="text" name="city" value="<?php echo $customer['city'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('city', $errors)) : ?>
                <span class="error"><?php echo $errors['city'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>State: </label>
        <input type="text" name="state" value="<?php echo $customer['state'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('state', $errors)) : ?>
                <span class="error"><?php echo $errors['state'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>Postal Code: </label>
        <input type="text" name="zip" value="<?php echo $customer['postalCode'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('postalCode', $errors)) : ?>
                <span class="error"><?php echo $errors['postalCode'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
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
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('phone', $errors)) : ?>
                <span class="error"><?php echo $errors['phone'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>Email: </label>
        <input type="text" name="email" value="<?php echo $customer['email'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('email', $errors)) : ?>
                <span class="error"><?php echo $errors['email'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>Password: </label>
        <input type="text" name="pass" value="<?php echo $customer['password'] ?>">
        <?php if(filter_has_var(INPUT_GET, 'error'))  : ?>
            <?php if(array_key_exists('password', $errors)) : ?>
                <span class="error"><?php echo $errors['password'] ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Customer">
        <br>

    </form>
    <p><a href=".">Search Customers</a></p>
</div>
<script src="app.js"></script>
<?php include '../view/footer.php'; ?>