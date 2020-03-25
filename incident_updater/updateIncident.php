<?php
include '../view/header.php';
require('../model/database__oo.php');
require('../model/incidents_db_oo.php');
session_start();
$incidentID = $_SESSION['incidentID'];
$email = $_SESSION['email'];
$incidentDB = new IncidentsDB();
$incident = $incidentDB->getIncident($incidentID);
function dateFormatter($dateStr) {
    $dateArr = date_parse($dateStr);
    return ($dateArr['month'].'/'.$dateArr['day'].'/'.$dateArr['year']);
};
$dateOpened = dateFormatter($incident['dateOpened']); 
$dateClosed = dateFormatter($incident['dateClosed']);
?>
<div id="main">
    <h1>Update Incident</h1>
    <div class="error">
    <?php 
    $error = false;
    if(filter_has_var(INPUT_GET, 'error')) {
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        foreach($errors as $error) {
            echo $error . "<br>";
        }
        $error = true; 
    };
    ?>
    </div>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="success">
        <label>IncidentID: </label>
        <?php echo $incidentID ?>
        <br>
        <label>Product Code: </label>
        <?php echo $incident['productCode'] ?>
        <br>
        <label>Date Opened: </label>
        <?php echo $dateOpened ?>
        <br>
        <label>Date Closed: </label>
        <input id="date" type="text" name="dateClosed" value="<?php echo ($error) ? $values[0] : $dateClosed ?>">
        <br>
        <label>Title: </label>
        <?php echo $incident['title'] ?>
        <br>
        <label>Description: </label>
        <textarea id="description" name="description" cols="30" rows="10"><?php echo $incident['description']; ?></textarea>
        <br>
        <input type="submit" value="Update Incident">
    </form>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <p>You are logged in as <?php echo $email ?></p>
        <input type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php' ?>