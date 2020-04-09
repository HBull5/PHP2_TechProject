<?php 
include "../view/header.php"; 
session_start();
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
<h1>Create Incident</h1>
<p>This incident was added to our database.</p>
</div>
<?php include "../view/footer.php"; ?>