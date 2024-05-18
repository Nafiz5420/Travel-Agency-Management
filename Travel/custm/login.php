<?php
include("db.php");
session_start();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['uname']) || empty($_POST['pass'])) {
        $error = "Please complete all the fields";
    } elseif (strlen($_POST['pass']) < 8) {
        $error = "Password must be at least 8 characters long";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['uname']);
        $passcode = mysqli_real_escape_string($conn, $_POST['pass']);

        $sql = "SELECT * FROM users WHERE usname = ? AND password = ?";
        
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $passcode);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $count = mysqli_stmt_num_rows($stmt);

            if ($count == 1) {
                $_SESSION['username'] = $username;

                if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                    setcookie('remember_username', $username, time() + 3600 * 24 * 30, '/');
                } else {
                    setcookie('remember_username', '', time() - 3600, '/');
                }

                header("location: index.php");
                exit();
            } else {
                $error = "Your Login Name or Password is invalid";
            }
            
            mysqli_stmt_close($stmt);
        }
    }
}

if (isset($_COOKIE['remember_username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['remember_username'];
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
    <script src="Lvalidate.js"></script>
</head><style>
body {
  background-image: url("b4.JPG");

}
</style>
<body>
    <table border="1">
        <tr>
            <th colspan="2">
                <a href="index.html"><img src="logo.jpg" height="180"></a>
                <p align="right">
                    <a href="login.php">Login</a>&nbsp;|&nbsp;
                    <a href="registration.php">Registration</a>
                </p>
            </th>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <form method="post" action="login.php" onsubmit="return validateForm()" id="loginForm" novalidate>
                    <fieldset style="width:350px">
                        <legend>Login</legend>
                        <?php if ($error) { ?>
                            <p><?php echo $error; ?></p>
                        <?php } ?>
                        <table border="0">
                            <tr>
                                <td><label for="uname_input">Username</label></td>
                                <td>:<input type="text" name="uname" id="uname_input" />
                                    <div id="usernameError" style="color: red;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pass_input">Password</label></td>
                                <td>:<input type="password" name="pass" id="pass_input" />
                                    <div id="passwordError" style="color: red;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="remember" /> Remember Me</td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="Login" value="Login" /></td>
                                <td><a href="forgetpassword.php">Forgotten Password?</a></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="3" style='border:none;'>
                <h4 align="center">Copyright ⓒ 2023</h4>
            </td>
        </tr>
    </table>
</body>
</html>
