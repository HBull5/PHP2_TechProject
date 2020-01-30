<?php include '../view/header.php'; ?>
<div id="main">
    <h1>Add Product</h1>
    <div class="error">
    <?php 
    if(filter_has_var(INPUT_GET, 'error')) {
        session_start();
        $errors = $_SESSION['errors'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
    };
    ?>
    </div>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="add">
        <label>Code: </label>
        <input type="text" name="code">
        <br>
        <label >Name: </label>
        <input type="text" name="name">
        <br>
        <label>Version: </label>
        <input type="text" name="version">
        <br>
        <label>Release Date: </label>
        <input type="text" name="date">
        <span>Use 'yyyy-mm-dd' format</span>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Add Product">
        <br>
    </form>
    <p><a href=".">View Product List</a></p>
</div>
<?php include '../view/footer.php'; ?>