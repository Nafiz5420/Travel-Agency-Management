<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php require 'header.php'; ?>

<?php
    session_start();
    include("db.php");

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM admin WHERE usname = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $fname = $row['funame'];
            $gender = $row['gender'];
            $bloodgroup = $row['bloodgroup'];
            $email = $row['email'];
            $phone = $row['phone'];
            $division = $row['division'];
            $country = $row['country'];
            $address = $row['address'];
            $postcode = $row['postcode'];
            $usname = $row['usname'];
?>

            <table align="center" border="1">
                <tr>
                    <td><strong>Name:</strong></td>
                    <td><?php echo $fname; ?></td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong></td>
                    <td><?php echo $gender; ?></td>
                </tr>
                <tr>
                    <td><strong>Blood Group:</strong></td>
                    <td><?php echo $bloodgroup; ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td><?php echo $phone; ?></td>
                </tr>
                <tr>
                    <td><strong>Division:</strong></td>
                    <td><?php echo $division; ?></td>
                </tr>
                <tr>
                    <td><strong>Country:</strong></td>
                    <td><?php echo $country; ?></td>
                </tr>
                <tr>
                    <td><strong>Address:</strong></td>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <td><strong>Postcode:</strong></td>
                    <td><?php echo $postcode; ?></td>
                </tr>
                <tr>
                    <td><strong>Username:</strong></td>
                    <td><?php echo $usname; ?></td>
                </tr>
            </table>

<?php
        }
    } else {
        echo "You are not logged in.";
    }
?>

<?php include 'footer.php'; ?>

</body>
</html>