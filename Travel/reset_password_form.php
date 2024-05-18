<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);

   
    $currentDate = date('Y-m-d H:i:s');
    $sql = "SELECT usname FROM admin WHERE reset_token = ? AND token_expiration_date > ?";

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $token, $currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
           
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET password = ?, reset_token = NULL, token_expiration_date = NULL WHERE reset_token = ?";

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $token);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Password reset successfully. You can now log in with your new password.";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            }
        } else {
            echo "Invalid or expired token.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Reset Password</h1>

    <form action="reset_password_form.php?token=<?php echo $_GET['token']; ?>" method="POST">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>