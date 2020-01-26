<?php include '../view/header.php'; ?>

<div id="main">
    <h1>Customer Login</h1>
    <div class="error">
    <?php 
    if(filter_has_var(INPUT_GET, 'error')) {
        session_start();
        $errors = $_SESSION['errors'];
        foreach($errors as $error) {
            echo $error . "<br>";
        };
    };
    ?>
    </div>
    <p>You must login before you can register a product.</p>
    <form action="." method="post">
        <label>Email:</label>
        <!-- <input type="hidden" name="action" value="register"> -->
        <input type="hidden" name="action" value="register">
        <input type="text" name="email">
        <input type="submit" value="Login">
    </form>
</div>

<?php include '../view/footer.php'; ?>