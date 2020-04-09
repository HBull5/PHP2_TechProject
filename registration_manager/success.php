<?php 
include '../view/header.php';
$code = filter_input(INPUT_GET, 'code'); 
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=customer");
} else if($_SESSION['validated'] != 'customer') {
    header("Location: ../login/login.php?type=customer");
}
?>
<div id="main">
<h1>Register Product</h1>
<p>Product (<?php echo $code ?>) was registered successfully.</p>
</div>
<?php include '../view/footer.php'; ?>