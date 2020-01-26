<?php 
include '../view/header.php';
$code = filter_input(INPUT_GET, 'code'); 
?>
<div id="main">
<h1>Register Product</h1>
<p>Product (<?php echo $code ?>) was registered successfully.</p>
</div>
<?php include '../view/footer.php'; ?>