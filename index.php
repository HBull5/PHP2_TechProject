<?php 
include 'view/header.php';
$https = filter_input(INPUT_SERVER, 'HTTPS');
if(!$https) {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $url = 'https://'.$host.$uri;
    header("Location: ".$url);
    exit();
}
?>
<div id="main">
    <h2>Main Menu</h2>
    <ul class="nav">
        <li><a href="login/index.php?type=admin">Administrators</a></li>
        <li><a href="login/index.php?type=tech">Technicians</a></li>
        <li><a href="login/index.php?type=customer">Customers</a></li>
    </ul>
</div>
<?php include 'view/footer.php' ?>