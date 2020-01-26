<?php include '../view/header.php'; ?>

<div id="main">
    <h1>Customer Login</h1>
    <p>You must login before you can register a product.</p>
    <form action="." method="post">
        <label>Email:</label>
        <input type="hidden" name="action" value="register">
        <input type="text" name="email">
        <input type="submit" value="Login">
    </form>
</div>

<?php include '../view/footer.php'; ?>