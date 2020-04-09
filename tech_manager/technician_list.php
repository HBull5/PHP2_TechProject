<?php 
include '../view/header.php'; 
session_start();
if(!isset($_SESSION['validated'])) {
    header("Location: ../login/login.php?type=admin");
} else if($_SESSION['validated'] != 'admin') {
    header("Location: ../login/login.php?type=admin");
}
?>
<div id="main">
<h1>Technician List</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Password</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach($techs as $tech) : ?>
    <tr>
        <?php 
        $techID = $tech['techID'];
        $fName = $tech['firstName'];
        $lName = $tech['lastName'];
        $email = $tech['email'];
        $phone = $tech['phone'];
        $pass = $tech['password'];
        $technician = new Technician($techID, $fName, $lName, $email, $phone, $pass);
        ?>
        <td><?php echo $technician->getFullName(); ?></td>
        <td><?php echo $technician->getEmail(); ?></td>
        <td><?php echo $technician->getPhone(); ?></td>
        <td><?php echo $technician->getPassword(); ?></td>
        <td><form action="." method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="technician" value="<?php echo $technician->getTechID(); ?>">
            <input type="submit" value="delete">
        </form></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><a href=".?action=showAdd">Add Technician</a></p>
</div>
<?php include '../view/footer.php' ?>