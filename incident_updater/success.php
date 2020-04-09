<?php 
include '../view/header.php';
session_start();
$email = $_SESSION['email'];
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=tech");
} else if($_SESSION['validated'] != 'tech') {
    header("Location: ../login/login.php?type=tech");
}
?>
<div id="main">
    <h1>Update Incident</h1>
    <p>This incident was updated.</p>
    <p><a href="select_incident.php">Select Another Incident</a></p>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <p>You are logged in as <?php echo $email ?></p>
        <input type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php' ?>