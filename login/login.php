<?php 
include '../view/header.php';
$type = filter_input(INPUT_GET, 'type');
switch($type) {
    case 'admin':
        $heading = 'Admin ';
        break;
    case 'tech':
        $heading = 'Technician ';
        break;
    case 'customer':
        $heading = 'Customer ';
        break;
} 
?>
<div id="main">
    <h2><?php echo $heading ?>Login</h2>
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
    <form action=".?type=<?php echo $type ?>" method="post" id="aligned">
        <input type="hidden" name="action" value="login">
        <label><?php echo ($type === 'admin') ? 'Username' : 'Email' ?></label>
        <input type="text" name="loginID" value="<?php echo $error ? $values[0] : "" ?>">
        <br>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $error ? $values[1] : "" ?>">
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Login">
    </form>
</div>
<?php include '../view/footer.php' ?>