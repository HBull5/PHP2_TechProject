<?php include '../view/header.php' ?>
<div id="main">
<h1>Create Incident</h1>
<form action="." method="post" id="aligned">
    <input type="hidden" name="action" value="complete">
    <label>Customer:</label>
    <label><?php echo $customer['firstName'] . " " . $customer['lastName'] ?></label>
    <br>
    <label>Product:</label>
    <select name="product">
        <?php foreach($registered as $product) : ?>
            <option value="<?php echo getProductName($product); ?>"><?php echo getProductName($product); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label>Title:</label>
    <input type="text" name="title">
    <br>
    <label>Description:</label>
    <textarea name="description" cols="30" rows="10"></textarea>
    <br>
    <label>&nbsp;</label>
    <input type="submit" value="Create Incident">
</form>
</div>
<?php include '../view/footer.php' ?>