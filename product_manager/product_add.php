<?php include '../view/header.php'; ?>
<!--THIS STILL NEEDS VALIDATION ADDED IN. IT JUST SPECIFIES THAT SOMETHING WAS ENTERED BUT MAYBE ATTEMPT TO VALIDATE BLANK && INCORRECT ENTRIES IF POSSIBLE-->
<div id="main">
    <h1>Add Product</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="add">
        <label>Code: </label>
        <input type="text" name="code">
        <br>
        <label >Name: </label>
        <input type="text" name="name">
        <br>
        <label>Version: </label>
        <input type="text" name="version">
        <br>
        <label>Release Date: </label>
        <input type="text" name="date">
        <span>Use 'yyyy-mm-dd' format</span>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Add Product">
        <br>
    </form>
    <p><a href=".">View Product List</a></p>
</div>
<?php include '../view/footer.php'; ?>