<?php include '../view/header.php';?>
<div id="main">
    <h1>Register Product</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="complete">
        <label>Customer:</label>
        <label><?php echo "Kelly irvin"; ?></label> 
        <br>
        <label>Product:</label>
        <select name="productName">
            <?php foreach($products as $product) : ?>
                <option value="<?php echo $product['name']?>"><?php echo $product['name']?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Register Product">
    </form>
</div>
<?php include '../view/footer.php';?>