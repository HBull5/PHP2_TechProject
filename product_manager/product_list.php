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
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode'] ?></td>
                <td><?php echo $product['name'] ?></td>
                <td><?php echo $product['version'] ?></td>
                <td><?php echo date_format(date_create($product['releaseDate']), 'n-j-Y') ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="code" value="<?php echo $product['productCode'] ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href=".?action=showAdd">Add Product</a></p>
</div>
<?php include '../view/footer.php' ?>