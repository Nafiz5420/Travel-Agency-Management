<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include("dbs.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $check_email_query = "SELECT COUNT(*) AS count, user_id FROM admin WHERE email = :email";
    try {
        $stmt = $conn->prepare($check_email_query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $id = $result['user_id'];

           
            $reset_url = "http://localhost/xampp/wbtsk/projectmid3/reset_password.php?id=" . base64_encode($id);


           
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'nafizahmed5420@gmail.com'; 
                $mail->Password = 'zmqkpryfxysgpxyh'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('nafizahmed5420@gmail.com', 'MD.Nafiz');
                $mail->addAddress($email); 

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body    = "Click the following link to reset your password: <a href='$reset_url'>$reset_url</a>";

                $mail->send();
                echo "Reset link sent to your email.";
            } catch (Exception $e) {
                $errors['email'] = "Error sending email. Please try again.";
            }
        } else {
            $errors['email'] = "Email not found.";
        }
    } catch (Exception $ex) {
        $errors['email'] = "Unexpected error occurred.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body><table> <tr>
    <table border="1" width="100%">
    <tr>
    
    <td align="center" colspan="2"  >
                    <a href="index.php"><img src="logo.png" height="180"></a>
                   
                </td>
   
    </tr> 
 </table>
    </tr>
 
    <tr>

    <h2>Forgot Password</h2>

    <form method="POST" action="forgot_password.php" novalidate>
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <span ><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span><br>

        <button type="submit" class="button"style="background-color: rgb(76, 83, 175); color: #fff; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
    </form>

    </table>
</tr>

<tr>
<table  border="1" width="100%">
    <tr>
        <td colspan="3" width="1920" height="50" >
            <h4 align="center">Copyright ⓒ 2023</h4>
        </td>
    </tr>
    </table>
    <tr>
        <table>
</body>
</html>