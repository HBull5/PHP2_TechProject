<?php include '../view/header.php' ?>
<div class="main">
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
        <td>$tech['firstName']; </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php include '../view/footer.php' ?>