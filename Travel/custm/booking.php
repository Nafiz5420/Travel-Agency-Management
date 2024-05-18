<?php
include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
?>

<html>
<head>
   
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
<table border="0">
    <tr>
        <td >
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
        <td>
        <table >
                            <tr ><b>Categories</b></tr>
                            <ul id="cats">
                                <?php getCats(); ?>
                            </ul>
                            <br>
                            <tr ><b>Types</b></tr>
                            <ul id="cats">
                                <?php getTypes(); ?>
                            </ul>
                        </table>
        </td>

    </tr>
    <tr><td> 
                            <?php getCatPack(); ?>
                            <?php getTypePack(); ?></td></tr>
    <tr>
        <td>
            <?php include 'footer.php'; ?>
        </td>
    </tr>
</table>

</body>
</html>