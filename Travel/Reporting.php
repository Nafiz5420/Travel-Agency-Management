<?php

include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} else {
    $employeeMessageStatus = $userMessageStatus = '';

    function storeMessage($message, $table, $conn)
    {
        // Validate and sanitize user input
        $message = trim($message);
        if (empty($message)) {
            return false; // Don't proceed if the message is empty
        }

        $message = mysqli_real_escape_string($conn, $message);
        $sql = "INSERT INTO $table (message) VALUES ('$message')";
        return mysqli_query($conn, $sql);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['employee_comment'])) {
            $employeeMessage = $_POST['employee_comment'];
            if (storeMessage($employeeMessage, 'employee_messages', $conn)) {
                $employeeMessageStatus = "Employee message sent successfully!";
            } else {
                $employeeMessageStatus = "Error sending employee message.";
            }
        } elseif (isset($_POST['user_comment'])) {
            $userMessage = $_POST['user_comment'];
            if (storeMessage($userMessage, 'user_messages', $conn)) {
                $userMessageStatus = "User message sent successfully!";
            } else {
                $userMessageStatus = "Error sending  user message.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Box</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function submitForm(formId, messageType) {
            var form = document.getElementById(formId);
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_message.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    var responseDiv = document.createElement('div');
                    responseDiv.textContent = 'Message sent: ' + this.responseText;
                    responseDiv.classList.add('message-response');
                    var fieldset = form.getElementsByTagName('fieldset')[0];
                    fieldset.appendChild(responseDiv);
                }
            };
            xhr.send(formData);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('employeeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm('employeeForm', 'employee');
            });
            document.getElementById('userForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm('userForm', 'user');
            });
        });
    </script>
</head>
<body>
    <?php require 'header.php'; ?>

    <form id="employeeForm" method="POST" action="" novalidate>
        <fieldset>
            <legend>Message for Employee</legend>
            <label for="employee_comment">Write Message:</label>
            <textarea name="employee_comment" rows="4" cols="50" required></textarea>
            <button type="submit">Submit for Employee</button>
        </fieldset>
    </form>

    <form id="userForm" method="POST" action="" novalidate>
        <fieldset>
            <legend>Message for User</legend>
            <label for="user_comment">Write Message:</label>
            <textarea name="user_comment" rows="4" cols="50" required></textarea>
            <button type="submit">Submit for User</button>
        </fieldset>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>
