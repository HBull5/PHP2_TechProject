<?php include '../view/header.php'; ?>
<div id="main">
    <h1>Customer Login</h1>
    <div class="error">
    <?php 
    $error = false;
    if(filter_has_var(INPUT_GET, 'error')) {
        session_start();
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
        $error = true;
    };
    ?>
    </div>
    <p>You must login before you can register a product.</p>
    <form action="." method="post">
        <label>Email:</label>
        <input type="hidden" name="action" value="register">
        <input type="text" name="email" value="<?php echo $error ? $values[0] : "" ?>">
        <input type="submit" value="Login">
    </form>
</div>
<?php include '../view/footer.php'; ?>