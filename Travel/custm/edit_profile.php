<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Edit Profile</h1>
   
    <?php
    session_start();
    include("db.php");
    $errors = [];
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newName = mysqli_real_escape_string($conn, $_POST['newName']);
            $newGender = mysqli_real_escape_string($conn, $_POST['newGender']);
            $newBloodGroup = mysqli_real_escape_string($conn, $_POST['newBloodGroup']);
            $newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);
            $newPhone = mysqli_real_escape_string($conn, $_POST['newPhone']);
            $newDivision = mysqli_real_escape_string($conn, $_POST['newDivision']);
            $newCountry = mysqli_real_escape_string($conn, $_POST['newCountry']);
            $newAddress = mysqli_real_escape_string($conn, $_POST['newAddress']);
            $newPostcode = mysqli_real_escape_string($conn, $_POST['newPostcode']);
            $newUsername = mysqli_real_escape_string($conn, $_POST['newUsername']);

            if (empty($newName)) {
                $errors['newName'] = "Name is required.";
            }
    
            if (empty($newEmail)) {
                $errors['newEmail'] = "Email is required.";
            } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['newEmail'] = "Invalid email format.";
            }
    
            if (empty($newPhone)) {
                $errors['newPhone'] = "Phone is required.";
            } elseif (!preg_match("/^[0-9]{11}$/", $newPhone)) {
                $errors['newPhone'] = "Phone must be an 11-digit number.";
            }
    
            if (empty($newDivision)) {
                $errors['newDivision'] = "Division is required.";
            }
    
            if (empty($newCountry)) {
                $errors['newCountry'] = "Country is required.";
            }
    
            if (empty($errors)) {
                $sql = "UPDATE users SET
                    funame = '$newName',
                    gender = '$newGender',
                    bloodgroup = '$newBloodGroup',
                    email = '$newEmail',
                    phone = '$newPhone',
                    division = '$newDivision',
                    country = '$newCountry',
                    address = '$newAddress',
                    postcode = '$newPostcode',
                    usname = '$newUsername'
                    WHERE usname = '$username'";

                if (mysqli_query($conn, $sql)) {
                    header("location: profile.php");
                    exit();
                } else {
                    echo "Error updating profile: " . mysqli_error($conn);
                }
            }
        }

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
        }
    
    ?>
    <table border="0">
    <tr>
        <td>
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
            <td colspan="3" width="1920" align="center"><table>
            <form method="POST" action="edit_profile.php" novalidate>
            <fieldset>
                        <legend>Edit Information</legend>
                <label for="newName">Name:</label>
                <input type="text" name="newName" value="<?php echo $fname; ?>">
                <span class="error"><?php echo isset($errors['newName']) ? $errors['newName'] : ''; ?></span><br>

                <label for="newGender">Gender:</label>
                <input type="text" name="newGender" value="<?php echo $gender; ?>"><br>

                <label for="newBloodGroup">Blood Group:</label>
                <input type="text" name="newBloodGroup" value="<?php echo $bloodgroup; ?>"><br>

                <label for="newEmail">Email:</label>
                <input type="text" name="newEmail" value="<?php echo $email; ?>">
                <span class="error"><?php echo isset($errors['newEmail']) ? $errors['newEmail'] : ''; ?></span><br>

                <label for="newPhone">Phone:</label>
                <input type="text" name="newPhone" value="<?php echo $phone; ?>">
                <span class="error"><?php echo isset($errors['newPhone']) ? $errors['newPhone'] : ''; ?></span><br>

                <label for="newDivision">Division:</label>
                <input type="text" name="newDivision" value="<?php echo $division; ?>">
                <span class="error"><?php echo isset($errors['newDivision']) ? $errors['newDivision'] : ''; ?></span><br>

                <label for="newCountry">Country:</label>
                <input type="text" name="newCountry" value="<?php echo $country; ?>">
                <span class="error"><?php echo isset($errors['newCountry']) ? $errors['newCountry'] : ''; ?></span><br>

                <label for="newAddress">Address:</label>
                <input type="text" name="newAddress" value="<?php echo $address; ?>"><br>

                <label for="newPostcode">Postcode:</label>
                <input type="text" name="newPostcode" value="<?php echo $postcode; ?>"><br>

                <label for="newUsername">Username:</label>
                <input type="text" name="newUsername" value="<?php echo $usname; ?>"><br>

                <button type="submit">Update Profile</button>
                </fieldset>
            </form> </table>
            <?php
    } else {
        echo "You are not logged in.";
    }
    ?> 
      <tr>
        <td>
            <?php include 'footer.php'; ?>
        </td>
    </tr>
</table>
</body>
</html>