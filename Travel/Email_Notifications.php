<?php

include("db.php");
session_start();

function authenticateUser($conn)
{
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
}

function sendEmailNotification($to, $subject, $message)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nafizahmed5420@gmail.com';
        $mail->Password = 'zmqkpryfxysgpxyh';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

authenticateUser($conn);

$toError = $subjectError = $messageError = $notificationStatus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_notification'])) {
    $to = htmlspecialchars($_POST['recipient_email']);
    $subject = htmlspecialchars($_POST['email_subject']);
    $message = htmlspecialchars($_POST['email_message']);

    // Validate inputs
    if (empty($to)) {
        $toError = "Please enter recipient email.";
    }

    if (empty($subject)) {
        $subjectError = "Please enter email subject.";
    }

    if (empty($message)) {
        $messageError = "Please enter email message.";
    }

    if (empty($toError) && empty($subjectError) && empty($messageError)) {
        if (sendEmailNotification($to, $subject, $message)) {
            $notificationStatus = "Email notification sent successfully!";
        } else {
            $notificationStatus = "Error sending email notification. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notifications and Security</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php require 'header.php'; ?>
    <h1>Email Notifications and Security</h1>

    <h2>Send Email Notification</h2>
    <form method="POST" action="" novalidate>
        <fieldset>
            <legend>Email Notification Form</legend>
            <label for="recipient_email">Recipient Email:</label>
            <input type="email" name="recipient_email" required>
            <span class="error"><?php echo $toError; ?></span><br>

            <label for="email_subject">Email Subject:</label>
            <input type="text" name="email_subject" required>
            <span class="error"><?php echo $subjectError; ?></span><br>

            <label for="email_message">Email Message:</label>
            <textarea name="email_message" rows="4" required></textarea>
            <span class="error"><?php echo $messageError; ?></span><br>

            <button type="submit" class="button" name="send_notification"style="background-color: rgb(76, 83, 175); color: #fff; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">Send Notification</button>
            <span class="notification-status"><?php echo $notificationStatus; ?></span>
        </fieldset>
    </form>
    <?php include 'footer.php'; ?>
</body>

</html>