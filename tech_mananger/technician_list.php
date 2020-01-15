<?php include '../view/header.php' ?>
<div id="main">
<h1>Technician List</h1>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Password</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach($techs as $tech) : ?>
    <tr>
        <td><?php echo $tech['firstName']; ?></td>
        <td><?php echo $tech['lastName']; ?></td>
        <td><?php echo $tech['email']; ?></td>
        <td><?php echo $tech['phone']; ?></td>
        <td><?php echo $tech['password']; ?></td>
        <td><form action="." method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="techID" value="<?php echo $tech['techID']; ?>">
            <input type="submit" value="delete">
        </form></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><a href=".?action=showAdd">Add Technician</a></p>
</div>
<?php include '../view/footer.php' ?>