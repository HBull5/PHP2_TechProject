<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!-- the head section -->
    <head>
        <title>SportsPro Technical Support</title>
        <link rel="stylesheet" type="text/css"
              href="../main.css"/>
    <link rel="stylesheet" href="main.css">
    </head>
<?php 
    $dir = getcwd();
    $explodedDir = explode("/", $dir);
    $currentDir = end($explodedDir);
    if($currentDir === 'incident_updater') {
        $home = '.';
    } else if($currentDir === 'registration_manager') {
        $home = '.';
    } else if($currentDir === 'PHP2_TechProject') {
        $home = '.';
    } else if($currentDir === 'login') {
        $home = '..';
    } else {
        $home = '../menu/adminMenu.php';
    }
?>
    <!-- the body section -->
    <body>
    <div id="page">
        <div id="header">
            <h1>SportsPro Technical Support</h1>
            <p>Sports management software for the sports enthusiast</p>
            <ul class="nav flex row">
                <li><a href="<?php echo $home; ?>">Home</a></li>
            </ul>
        </div>
       