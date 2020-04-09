<?php 
include '../view/header.php';
session_start();
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
    <h1>Add Product</h1>
    <div class="error">
    <?php 
    $error = false;
    if(filter_has_var(INPUT_GET, 'error')) {
        // session_start();
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
        $error = true; 
    };
    ?>
    </div>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="add">
        <label>Code: </label>
        <input type="text" name="code" value="<?php echo ($error) ? $values[0] : "" ?>">
        <br>
        <label >Name: </label>
        <input type="text" name="name" value="<?php echo ($error) ? $values[1] : "" ?>">
        <br>
        <label>Version: </label>
        <input type="text" name="version" value="<?php echo ($error) ? $values[2] : "" ?>">
        <br>
        <label>Release Date: </label>
        <input type="text" name="date" value="<?php echo ($error) ? $values[3] : "" ?>">
        <span>Use any valid date format</span>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Add Product">
        <br>
    </form>
    <p><a href=".">View Product List</a></p>
</div>
<?php include '../view/footer.php'; ?>