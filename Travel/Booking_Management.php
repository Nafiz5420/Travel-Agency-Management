<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
 else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php require 'header.php'; ?>
        <table   width="100%">
            <tr >
                <td align="center">
                <h2>Manage Content</h2>
                    <ul >
                    <li><a href="Booking_Management.php?insert_cat">Insert New Categories</a></li>
                        <li><a href="Booking_Management.php?view_cats">View All Categories</a></li>
                        <li><a href="Booking_Management.php?insert_type">Insert New Types</a></li>
                        <li><a href="Booking_Management.php?view_types">View All Types</a></li>
                       
                        </ul>
                </td>
                <td>
                    <h2><?php echo @$_GET['logged_in']; ?></h2>
                    <?php
                     if (isset($_GET['insert_cat'])) {
                        include("insert_cat.php");
                    }
                    if (isset($_GET['view_cats'])) {
                        include("view_cats.php");
                    }
                    if (isset($_GET['insert_type'])) {
                        include("insert_type.php");
                    }
                    if (isset($_GET['view_types'])) {
                        include("view_types.php");
                    }
                    ?>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        <?php
    }
    ?>
    <?php include 'footer.php'; ?>