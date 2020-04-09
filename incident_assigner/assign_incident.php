<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/customer_db_oo.php');
require('../model/technician_db_oo.php');
require('../model/incidents_db_oo.php');
$technicianDB = new TechnicianDB();
$customerDB = new CustomerDB();
$incidentDB = new IncidentsDB();
session_start();
$techID = $_SESSION['techID'];
$incidentID = $_SESSION['incidentID'];
$techName = $technicianDB->getTechName($techID);
$incident = $incidentDB->getIncident($incidentID);
$custID = $incident['customerID'];
$customer = $customerDB->getCustomer($custID);
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
    <h1>Assign Incident</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="success">
        <label>Customer: </label>
        <?php echo $customer['firstName'].' '.$customer['lastName'] ?>
        <br>
        <label>Product: </label>
        <?php echo $incident['productCode'] ?>
        <br>
        <label>Technician: </label>
        <?php echo $techName[0] ?>
        <br>
        <input type="submit" value="Assign Incident">
    </form>
</div>
<?php include '../view/footer.php' ?>