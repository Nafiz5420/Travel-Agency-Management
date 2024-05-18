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
                    <li><a href="Payment_Gateway.php?view_payments">view_payments</a></li>
                    <li><a href="Payment_Gateway.php?payment_form">Pay Now</a></li>
                   

                        </ul>
                </td>
                <td>
                    <h2><?php echo @$_GET['logged_in']; ?></h2>
                    <?php
                    if (isset($_GET['payment_form'])) {
                        include("payment_form.php");
                    }
                    if (isset($_GET['view_payments'])) {
                        include("view_payments.php");
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