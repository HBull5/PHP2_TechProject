<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
$incidentDB = new IncidentsDB();
session_start();
$techID = $_SESSION['techID'];
$incidentID = $_SESSION['incidentID'];
$incidentDB->assignIncident($techID, $incidentID);
unset($_SESSION['techID']);
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
    <h1>Assign Incident</h1>
    <p>This incident was assigned to a technician.</p>
    <p><a href="select_incident.php">Select Another Incident</a></p>
</div>
<?php include '../view/footer.php' ?>