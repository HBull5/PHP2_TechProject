<?php 
include '../view/header.php';
$registeredProducts = getRegisteredProducts($custID);
$unregisteredProducts = getUnregisteredProducts($registeredProducts);
?>
<div id="main">
    <h1>Register Product</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="complete">
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
</div>
<?php include '../view/footer.php';?>