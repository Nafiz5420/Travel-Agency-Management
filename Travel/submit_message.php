<?php
include("db.php");
session_start();

$response = '';

function storeMessage($message, $table, $conn) {
    $message = trim($message);
    if (empty($message)) {
        return "Message cannot be empty.";
    }
    $message = mysqli_real_escape_string($conn, $message);
    $sql = "INSERT INTO $table (message) VALUES ('$message')";
    return mysqli_query($conn, $sql) ? $message : "Error sending message.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee_comment'])) {
        $response = storeMessage($_POST['employee_comment'], 'employee_messages', $conn);
    } elseif (isset($_POST['user_comment'])) {
        $response = storeMessage($_POST['user_comment'], 'user_messages', $conn);
    }
}

echo $response;
?>
