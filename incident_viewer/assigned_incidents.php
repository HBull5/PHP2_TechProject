<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
require('../model/product_db_oo.php');
require('../model/technician_db_oo.php');
$incidentDB = new IncidentsDB();
$productDB = new ProductDB();
$technicianDB = new TechnicianDB();
$assignedIncidents = $incidentDB->getAllAssignedIncidents();
function dateFormatter($dateStr) {
    $dateArr = date_parse($dateStr);
    return ($dateArr['month'].'/'.$dateArr['day'].'/'.$dateArr['year']);
};
?>
<div id="main">
    <h1>Assigned Incidents</h1>
    <p><a href=".">View Unassigned Incidents</a></p>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Technician</th>
            <th>Incident</th>
        </tr>
    <?php foreach($assignedIncidents as $incident) : ?>
    <?php 
        $dateOpened = dateFormatter($incident['dateOpened']);   
        $dateClosed = dateFormatter($incident['dateClosed']);
    ?>
        <tr>
            <td><?php echo $incident['fullName'] ?></td>
            <td><?php echo $productDB->getProductName($incident['productCode']) ?></td>
            <td><?php echo $technicianDB->getTechName($incident['techID'])[0] ?></td>
            <td id="aligned">
                <label>ID: </label>
                <?php echo $incident['incidentID'] ?>
                <br>
                <label>Opened: </label>
                <?php echo $dateOpened ?>
                <br>
                <label>Closed: </label>
                <?php echo ($dateClosed == '//') ? 'OPEN' : $dateClosed ?>
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