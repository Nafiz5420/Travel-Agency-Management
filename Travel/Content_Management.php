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
                    <li><a href="Content_Management.php?insert_package">Insert New Package</a></li>
                        <li><a href="Content_Management.php?view_packages">View All Packages</a></li>
                        <li><a href="Content_Management.php?"></a></li>

                        </ul>
                </td>
                <td>
                    <h2><?php echo @$_GET['logged_in']; ?></h2>
                    <?php
                    if (isset($_GET['insert_package'])) {
                        include("insert_package.php");
                    }
                    if (isset($_GET['view_packages'])) {
                        include("view_packages.php");
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