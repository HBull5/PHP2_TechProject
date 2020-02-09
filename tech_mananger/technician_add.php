<?php include '../view/header.php'; ?>
<div id="main">
<h1>Add Technician</h1>
<div class="error"><?php  
    if(filter_has_var(INPUT_GET, 'error')) {
        session_start();
        $errors = $_SESSION['errors'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
    };
?></div>
<form action="." method="post" id="aligned">
    <input type="hidden" name="action" value="add">
    <label>First Name: </label>
    <input type="text" name="fName">
    <br>
    <label>Last Name: </label>
    <input type="text" name="lName">
    <br>
    <label>Email: </label>
    <input type="text" name="email">
    <br>
    <label>Phone: </label>
    <input type="text" name="phone">
    <span>Use 'XXX-XXX-XXXX' format</span>
    <br>
    <label>Password: </label>
    <input type="text" name="password">
    <br>
    <label>&nbsp;</label>
    <input type="submit" value="Add Technician">
    <br>
</form>
<p><a href=".">View Technician List</a></p>
</div>
<?php include '../view/footer.php'; ?>