<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

      
        $userExists = true; 

        if ($userExists) {
      
            $token = substr(base64_encode(random_bytes(12)), 0, 16);

          
            $expires = time() + 3600;

            $insertTokenQuery = "INSERT INTO password_reset_requests (email, token, expires) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertTokenQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssi", $email, $token, $expires);
                if (mysqli_stmt_execute($stmt)) {
                
                    $resetLink = "passwordreset.php?token=" . $token;
                 
                    mail($email, "Password Reset", "Click the following link to reset your password: $resetLink");
                    echo "An email with a password reset link has been sent to your email address.";
                } else {
                    echo "Error storing the token in the database.";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            echo "No user found with this email address.";
        }
    }
}
?>