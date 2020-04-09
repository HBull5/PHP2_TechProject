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
<h1>Get Customer</h1>
<div class="error">
<?php 
$error = false;
if(filter_has_var(INPUT_GET, 'errors')) {
    $errors = $_SESSION['errors'];
    $values = $_SESSION['values'];
    foreach($errors as $error) {
        echo $error . "<br>";
    }
    $error = true;
};
?>
</div>
<p>You must enter the customer's email address to select the customer</p>
<form action="." method="post">
    <input type="hidden" name="action" value="createIncident">
    <label>Email: </label>
    <input type="text" name="email" value="<?php echo ($error) ? $values[0] : "" ?>">
    <input type="submit">
</form>
</div>
<?php include '../view/footer.php' ?>