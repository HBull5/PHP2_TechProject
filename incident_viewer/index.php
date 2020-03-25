<?php 
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
require('../model/product_db_oo.php');
include '../view/header.php';
$incidentDB = new IncidentsDB();
$productDB = new ProductDB();
$unassignedIncidents = $incidentDB->getUnassignedIncidents();
function dateFormatter($dateStr) {
    $dateArr = date_parse($dateStr);
    return ($dateArr['month'].'/'.$dateArr['day'].'/'.$dateArr['year']);
};
?>
<div id="main">
    <h1>Unassigned Incidents</h1>
    <p><a href="assigned_incidents.php">View Assigned Incidents</a></p>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Incident</th>
        </tr>
    <?php foreach($unassignedIncidents as $incident) : ?>
        <tr>
            <td><?php echo $incident['firstName'].' '.$incident['lastName'] ?></td>
            <td><?php echo $productDB->getProductName($incident['productCode']) ?></td>
            <td id="aligned">
                <label>ID: </label>
                <?php echo $incident['incidentID'] ?>
                <br>
                <label>Opened: </label>
                <?php echo dateFormatter($incident['dateOpened']) ?>
                <br>
                <label>Title: </label>
                <?php echo $incident['title'] ?>
                <br>
                <label>Description: </label>
                <?php echo $incident['description'] ?>
                <br>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<?php include '../view/footer.php' ?>