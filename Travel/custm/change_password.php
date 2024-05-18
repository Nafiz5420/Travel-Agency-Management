<?php
                session_start();
                include("db.php");
                if (!isset($_SESSION['username'])) {
                    header("location: login.php");
                    exit();
                }
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
                        $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
                        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

                        $errors = array();

                        $checkPasswordSQL = "SELECT password FROM users WHERE usname = '$username'";
                        $result = mysqli_query($conn, $checkPasswordSQL);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $dbPassword = $row['password'];

                            if (strlen($newPassword) < 8) {
                                $errors['newPassword'] = "Password must be at least 8 characters.";
                            }

                            if ($currentPassword !== $dbPassword) {
                                $errors['currentPassword'] = "Current password is incorrect.";
                            }

                            if ($newPassword !== $confirmPassword) {
                                $errors['confirmPassword'] = "New password and confirm password do not match.";
                            }

                            if (empty($errors)) {
                             
                                $updatePasswordSQL = "UPDATE users SET password = '$newPassword' WHERE usname = '$username'";
                                mysqli_query($conn, $updatePasswordSQL);
                                echo "Password changed successfully!";
                            }
                        }
                    }}
                    ?>  
                    <!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("currentPassword").addEventListener("input", validateCurrentPassword);
            document.getElementById("newPassword").addEventListener("input", validateNewPassword);
            document.getElementById("confirmPassword").addEventListener("input", validateConfirmPassword);
        };

        function validateCurrentPassword() {
            var currentPassword = document.getElementById("currentPassword").value;
            var errorSpan = document.getElementById("errorCurrentPassword");

            if (currentPassword === "") {
                errorSpan.innerHTML = "Please enter the current password";
                return false;
            } else {
                errorSpan.innerHTML = "";
                return true;
            }
        }

        function validateNewPassword() {
            var newPassword = document.getElementById("newPassword").value;
            var errorSpan = document.getElementById("errorNewPassword");

            if (newPassword === "") {
                errorSpan.innerHTML = "Please enter a new password";
                return false;
            } else if (newPassword.length < 8) {
                errorSpan.innerHTML = "Password must be at least 8 characters long";
                return false;
            } else {
                errorSpan.innerHTML = "";
                return true;
            }
        }

        function validateConfirmPassword() {
            var confirmPassword = document.getElementById("confirmPassword").value;
            var newPassword = document.getElementById("newPassword").value;
            var errorSpan = document.getElementById("errorConfirmPassword");

            if (confirmPassword !== newPassword) {
                errorSpan.innerHTML = "New password and confirm password do not match";
                return false;
            } else {
                errorSpan.innerHTML = "";
                return true;
            }
        }

        function validateForm() {
            return validateCurrentPassword() && validateNewPassword() && validateConfirmPassword();
        }
    </script>
</head>
<body>
    <?php
    // PHP code
    ?>
    <table border="0">
        <tr>
            <td>
                <?php require 'headline.php'; ?>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <form method="POST" action="change_password.php" onsubmit="return validateForm()" novalidate>
                        <fieldset>
                            <legend>Change password</legend>
                            <label for="currentPassword">Current Password:</label>
                            <input type="password" id="currentPassword" name="currentPassword" required>
                            <span class="error" id="errorCurrentPassword"><?php echo isset($errors['currentPassword']) ? $errors['currentPassword'] : ''; ?></span><br>

                            <label for="newPassword">New Password:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <span class="error" id="errorNewPassword"><?php echo isset($errors['newPassword']) ? $errors['newPassword'] : ''; ?></span><br>

                            <label for="confirmPassword">Confirm New Password:</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                            <span class="error" id="errorConfirmPassword"><?php echo isset($errors['confirmPassword']) ? $errors['confirmPassword'] : ''; ?></span><br>

                            <button type="submit">Change Password</button>
                        </fieldset>
                    </form>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <?php include 'footer.php'; ?>
            </td>
        </tr>
    </table>
</body>
</html>
