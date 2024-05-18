<?php
include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table border="0" cellspacing="0">
   
            <?php require 'headline.php'; ?>
      
        <td>
            <table border="0" cellspacing="0">
                <tr>
                    <td><b>Contact Us</b></td>
                </tr>
                <tr>
                    <td><b>24/7 Hotline</b></td>
                </tr>
                <tr>
                    <td><b>Dial: 012345</b></td>
                </tr>
            </table>
        </td>
        <td>
            <table border="1">
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td><h2>Our Local Guides</h2></td>
                </tr>
                <tr align="center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Contact</th>
                </tr>
                <?php
                $get_c = "SELECT * FROM employees";
                $run_c = mysqli_query($conn, $get_c);
                $i = 0;

                while ($row_c = mysqli_fetch_array($run_c)) {
                    $e_id = $row_c['emp_id'];
                    $e_name = $row_c['emp_name'];
                    $e_email = $row_c['emp_email'];
                    $e_designation = $row_c['emp_designation'];
                    $e_location = $row_c['emp_location'];
                    $e_address = $row_c['emp_address'];
                    $e_contact = $row_c['emp_contact'];
                    $i++;
                ?>
                <tr align="left">
                    <td><?php echo $e_name; ?></td>
                    <td><?php echo $e_email; ?></td>
                    <td><?php echo $e_location; ?></td>
                    <td align="center"><?php echo $e_address; ?></td>
                    <td><?php echo $e_contact; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3"><br><br><br></td>
    </tr>
    <tr>
        <td><h3>Head Office:</h3>
            <p><b>Address: </b>Kuratoli 7/A Street,Dhaka, Bangladesh.<br>
                <b>Contact: </b>123456789
            </p>
        </td>
        <td><h4>Regional Office:</h4>
            <p><b>Address: </b>Cox's Bazar,  Chittagong Division, Bangladesh<br>
                <b>Contact: </b>0987654321
            </p>
        </td>
        <td>
        
            <?php include "footer.php"; ?>
          
        </td>
    </tr>
</table>

</body>
</html>