<?php 
include '../view/header.php'; 
session_start();
?>
<div id="main">
    <h2>Admin Menu</h2>
    <ul class="nav">
        <li><a href="../product_manager">Manage Products</a></li>
        <li><a href="../tech_manager">Manage Technicians</a></li>
        <li><a href="../customer_manager">Manage Customers</a></li>
        <li><a href="../incident_creator">Create Incident</a></li>
        <li><a href="../incident_assigner">Assign Incident</a></li>
        <li><a href="../incident_viewer">Display Incidents</a></li>
    </ul>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <p>You are logged in as <?php echo $_SESSION['loginID']['username'] ?></p>
        <input type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php' ?>