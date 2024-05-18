<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>My Profile</h1>
    <table border="0">
    <tr>
        <td >
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
            <td colspan="3" width="1920" align="center">
        <table > <fieldset>
                        <legend>Personal Information</legend>

    <?php
    session_start();
    include("db.php");
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM users WHERE usname = '$username'";
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

            echo "<p><strong>Name:</strong> $fname</p>";
            echo "<p><strong>Gender:</strong> $gender</p>";
            echo "<p><strong>Blood Group:</strong> $bloodgroup</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone:</strong> $phone</p>";
            echo "<p><strong>Division:</strong> $division</p>";
            echo "<p><strong>Country:</strong> $country</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Postcode:</strong> $postcode</p>";
            echo "<p><strong>Username:</strong> $usname</p>";
        }
    } else {
        echo "You are not logged in.";
    }
    ?>
    </fieldset>
      <tr>
        <td>
            <?php include 'footer.php'; ?>
        </td>
    </tr>
</table>
</body>
</html>