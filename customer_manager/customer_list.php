<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/customer_db_oo.php');
$customerDB = new CustomerDB();
session_start();
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
<h1>Customer Search</h1>
<form action="." method="post">
    <label>Last Name: </label>
    <input type="text" name="search">
    <input type="submit" name="submitBtn" value="Search">
</form>
<?php if(filter_has_var(INPUT_GET, 'search')) : ?>
    <?php 
    $search = filter_input(INPUT_GET, 'search');
    $results = $customerDB->getSearchResults($search);
    ?>
    <h1>Results</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>City</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($results as $result) : ?>
            <tr>
                <td><?php echo $result['firstName'] . " " . $result['lastName']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['city']; ?></td>
                <form action="." method="post">
                    <input type="hidden" name="action" value="updateCustomers">
                    <input type="hidden" name="custID" value="<?php echo $result['customerID']; ?>">
                    <td><input type="submit" value="Select"></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<form action="." method="post">
    <h1>Add a new customer</h1>
    <input type="hidden" name="action" value="addCustomer">
    <input type="submit" value="Add Customer">
</form>
</div>
<?php include '../view/footer.php' ?>