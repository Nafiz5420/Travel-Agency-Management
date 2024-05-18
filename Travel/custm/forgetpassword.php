<?php
include("db.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        $email = mysqli_real_escape_string($conn, $email);
        $token = bin2hex(random_bytes(32));
        $timestamp = time() + 3600;

        $insertTokenQuery = "INSERT INTO password_reset_tokens (email, token, expires) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertTokenQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $email, $token, $timestamp);

            if (mysqli_stmt_execute($stmt)) {
                $resetLink = "http://example.com/reset_password.php?token=" . $token; 
                $subject = "Password Reset";
                $message = "To reset your password, click the following link: $resetLink";
                $headers = "From: email@gmail.com";

               
                if (mail($email, $subject, $message, $headers)) {
                    echo "An email with a password reset link has been sent to your email address.";
                } else {
                    echo "Error sending the email.";
                }
            } else {
                echo "Error storing the reset token in the database.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the SQL statement.";
        }
    } else {
        echo "Invalid email address. Please enter a valid email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Forget Password</h1>

    <form method="post" action="forget_password_handler.php" novalidate>
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>