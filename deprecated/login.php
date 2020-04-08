<?php include '../view/header.php' ?>
<div id="main">
    <h1>Technician Login</h1>
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
    <p>You must login before you can update an incident.</p>
    <form action="." method="post">
        <input type="hidden" name="action" value="selectIncident">
        <label>Email: </label>
        <input type="text" name="email" value="<?php echo $error ? $values[0] : "" ?>">
        <input type="submit" value="Login">
    </form>
</div>
<?php include '../view/footer.php' ?>