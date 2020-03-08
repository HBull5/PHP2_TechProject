<?php 
include '../view/header.php';
session_start();
$custID = $_SESSION['custID'];
$customer = $_SESSION['customer'];
$unregisteredProducts = $_SESSION['unregisteredProducts'];
?>
<div id="main">
    <h1>Register Product</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="complete">
        <input type="hidden" name="custID" value="<?php echo $custID ?>">
        <label>Customer:</label>
        <label><?php echo $customer['firstName'] . " " . $customer['lastName'] ?></label> 
        <br>
        <label>Product:</label>
        <select name="productName">
            <?php foreach($unregisteredProducts as $product) : ?>
                <option value="<?php echo $product ?>"><?php echo $product ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Register Product">
    </form>
    <br>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <p>You are logged in as <?php echo $customer['email'] ?></p>
        <input type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php';?>