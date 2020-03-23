<?php include '../view/header.php'; ?>
<div id="main">
<h1>Create Incident</h1>
<div class="error">
<?php 
    $error = false;
    if(filter_has_var(INPUT_GET, 'errors')) {
        require('../model/database.php');
        require('../model/database__oo.php');
        // require('../model/product_db.php');
        require('../model/product_db_oo.php');
        $productDB = new ProductDB();
        session_start();
        $errors = $_SESSION['errors'];
        $custID = $_SESSION['custID'];
        $customer = $_SESSION['customer'];
        $registered = $_SESSION['registered'];
        $values = $_SESSION['values'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
        $error = true;
    };
?>
</div>
<form action="." method="post" id="aligned">
    <input type="hidden" name="action" value="complete">
    <input type="hidden" name="custID" value="<?php echo $custID; ?>">
    
    <label>Customer:</label>
    <label><?php echo $customer['firstName'] . " " . $customer['lastName'] ?></label>
    <br>
    <label>Product:</label>
    <select name="code">
        <?php foreach($registered as $product) : ?>
            <option value="<?php echo $product; ?>"><?php echo $productDB->getProductName($product); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo ($error) ? $values[0] : "" ?>">
    <br>
    <label>Description:</label>
    <textarea name="description" cols="30" rows="10"></textarea>
    <br>
    <label>&nbsp;</label>
    <input type="submit" value="Create Incident">
</form>
</div>
<?php include '../view/footer.php' ?>