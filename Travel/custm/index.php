<?php
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
    <?php require 'headline.php'; ?>

        <tr>
            <td>
                <table border="0" >
                    <tr>
                        <td align="left"  width="230" >
                            <h3 ><b>PROFILE DASHBOARD</b></h3>
                            <ul id="menu">
        <li><a href="booking.php">Search and Booking</a></li>
        <li><a href="profile.php">My Account</a></li>
        <li><a href="edit_profile.php">edit profile</a></li>
        <li><a href="change_password.php">Change Password</a></li>  
        <li><a href="Booking_history.php">Booking History</a></li>
        <li><a href="pay.php">Payment</a></li>
        <li><a href="comment.php">comment</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
                        </td>
                        
                    </tr>
<tr>
    <td>
     
                    </td>
                    </tr>
                    <?php include 'footer.php'; ?>
    </table>

</body>
</html>