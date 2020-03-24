<?php 
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
$incidentDB = new IncidentsDB();
$results = $incidentDB->getUnassignedIncidents();
?>
<div id="main">
    <h1>Select Incident</h1>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($results as $row) : ?>
        <tr>
            <td><?php echo $row['firstName'].'<br>'.$row['lastName'] ?></td>
            <td><?php echo $row['productCode'] ?></td>
            <td><?php echo $row['dateOpened'] ?></td>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action" value="selectTech">
                <input type="hidden" name="incidentID" value="<?php echo $row['incidentID'] ?>">
                <input type="submit" value="Select">
            </form></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<?php include '../view/footer.php' ?>