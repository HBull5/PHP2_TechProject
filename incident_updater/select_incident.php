<?php
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
$incidentDB = new IncidentsDB();
session_start();
$techID = $_SESSION['techIDLogin'];
$email = $_SESSION['email'];
$incidents = $incidentDB->getIncidentsAssignedToTechID($techID);
function dateFormatter($dateStr) {
    $dateArr = date_parse($dateStr);
    return ($dateArr['month'].'/'.$dateArr['day'].'/'.$dateArr['year']);
};
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=tech");
} else if($_SESSION['validated'] != 'tech') {
    header("Location: ../login/login.php?type=tech");
}
?>
<div id="main">
    <h1>Select Incident</h1>
    <?php if(empty($incidents)) : ?>
        <p>There are no open incidents for this technician</p>
        <p><a href="select_incident.php">Refresh List of Incidents</a></p>
    <?php else : ?>
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
        <?php foreach($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['fullName'] ?></td>
                <td><?php echo $incident['productCode'] ?></td>
                <td><?php echo dateFormatter($incident['dateOpened']) ?></td>
                <td><?php echo $incident['title'] ?></td>
                <td><?php echo $incident['description'] ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="incidentID" value="<?php echo $incident['incidentID'] ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <p>You are logged in as <?php echo $email ?></p>
        <input type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php' ?>