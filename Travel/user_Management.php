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
                    <li><a href="user_Management.php?insert_employee">Insert New Employee</a></li>
                        <li><a href="user_Management.php?view_employees">View All Employees</a></li>
                        <li><a href="user_Management.php?view_users">View All Users</a></li>

                        </ul>
                </td>
                <td>
                    <h2><?php echo @$_GET['logged_in']; ?></h2>
                    <?php
                     if (isset($_GET['view_users'])) {
                        include("view_users.php");
                    }
                    if (isset($_GET['insert_employee'])) {
                        include("insert_employee.php");
                    }
                    if (isset($_GET['view_employees'])) {
                        include("view_employees.php");
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