<?php
require_once 'dbs.php';

$msg = "";
$passwordError = "";
$confirmPasswordError = "";

if (isset($_POST['submitpass'])) {
    $id = base64_decode($_GET["id"]);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $password = trim($password); 
    $confirmPassword = trim($confirmPassword);

   
    if ($id && strlen($password) >= 6 && $password === $confirmPassword) {
        $update_password_query = "UPDATE admin SET `password` = :password WHERE `user_id` = :id";

        try {
         
            $stmt = $conn->prepare($update_password_query);
            $stmt->bindValue(":password", $password);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            $msg = "Password changed successfully!";
            $msgType = "success";

          
            header("Location: login.php");
            exit();
        } catch (Exception $ex) {
            $msg = "Something went wrong. Please try again!";
            $msgType = "danger";
        }
    } else {
        if (strlen($password) < 8) {
            $passwordError = "Password must be at least 8 characters long.";
        }

        if ($password !== $confirmPassword) {
            $confirmPasswordError = "Passwords do not match.";
        }

    
    }
}

 ?>

<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <table>
        <tr>
            <table border="1" width="100%">
                <tr>
                    <td align="center" colspan="2">
                        <a href="index.php"><img src="logo.png" height="180"></a>
                    </td>
                </tr>
            </table>
        </tr>
        <tr>
            <td>
                <h2>Reset Password</h2>
                <form method="POST"  action="reset_password.php?id=<?php echo $_GET["id"]; ?>" novalidate>
                    <fieldset>
                        <legend>fr_password</legend>
                        <label for="password">Enter your new password:</label>
                        <input type="password" name="password" required minlength="8">
                        <span style="color: red;"><?php echo $passwordError; ?></span>
                        <br>
                        <label for="confirm_password">Confirm your new password:</label>
                        <input type="password" name="confirm_password" required minlength="8">
                        <span style="color: red;"><?php echo $confirmPasswordError; ?></span>
                        <br>
                        <button type="submit" name="submitpass">Submit</button>
                    </fieldset>
                </form>
            </td>
        </tr>
        <tr>
            <table  border="1" width="100%">
                <tr>
                    <td colspan="3" width="1920" height="50">
                        <h4 align="center">Copyright ⓒ 2023</h4>
                    </td>
                </tr>
            </table>
        </tr>
    </table>
</body>
</html>