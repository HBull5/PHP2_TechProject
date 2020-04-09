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
<h1>Add Technician</h1>
<div class="error">
<?php
    $error = false;
    if(filter_has_var(INPUT_GET, 'error')) {
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
        $error = true;
    };
?></div>
<form action="." method="post" id="aligned">
    <input type="hidden" name="action" value="add">
    <label>First Name: </label>
    <input type="text" name="fName" value="<?php echo ($error) ? $values[0] : "" ?>">
    <br>
    <label>Last Name: </label>
    <input type="text" name="lName" value="<?php echo ($error) ? $values[1] : "" ?>">
    <br>
    <label>Email: </label>
    <input type="text" name="email" value="<?php echo ($error) ? $values[2] : "" ?>">
    <br>
    <label>Phone: </label>
    <input type="text" name="phone" value="<?php echo ($error) ? $values[3] : "" ?>">
    <span>Use 'XXX-XXX-XXXX' format</span>
    <br>
    <label>Password: </label>
    <input type="text" name="password" value="<?php echo ($error) ? $values[4] : "" ?>">
    <br>
    <label>&nbsp;</label>
    <input type="submit" value="Add Technician">
    <br>
</form>
<p><a href=".">View Technician List</a></p>
</div>
<?php include '../view/footer.php'; ?>