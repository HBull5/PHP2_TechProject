<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
$incidentDB = new IncidentsDB();
$results = $incidentDB->getAssignedIncidents();
?>
<div id="main">
    <h1>Select Technician</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Open Incidents</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($results as $row) : ?>
        <tr>
            <td><?php echo $row['fullName'] ?></td>
            <td><?php echo $row['activeIncidents'] ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action" value="assign">
                <input type="hidden" name="techID" value="<?php echo $row['techID'] ?>">
                <input type="submit" value="Select">
            </form></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<?php include '../view/footer.php' ?>