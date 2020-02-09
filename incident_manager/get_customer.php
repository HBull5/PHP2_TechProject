<?php include '../view/header.php' ?>
<div id="main">
<h1>Get Customer</h1>
<div class="error">
<?php 
if(filter_has_var(INPUT_GET, 'errors')) {
    session_start();
    $errors = $_SESSION['errors'];
    foreach($errors as $error) {
        echo $error . "<br>";
    }
};
?>
</div>
<p>You must enter the customer's email address to select the customer</p>
<form action="." method="post">
    <input type="hidden" name="action" value="createIncident">
    <label>Email: </label>
    <input type="text" name="email">
    <input type="submit">
</form>
</div>
<?php include '../view/footer.php' ?>