<?php
session_start();
require_once("db.php");

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST["name"]);
    $phone = sanitizeInput($_POST["phone"]);
    $emergencyType = sanitizeInput($_POST["emergency_type"]);
    $details = sanitizeInput($_POST["details"]);

   
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($phone)) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        $errors['phone'] = "Invalid phone number format. Please enter a 10-digit number.";
    }

    $validEmergencyTypes = ["medical", "accident", "other"];
    if (empty($emergencyType) || !in_array($emergencyType, $validEmergencyTypes)) {
        $errors['emergency_type'] = "Invalid emergency type.";
    }

    if (empty($details)) {
        $errors['details'] = "Details are required.";
    }
}
?>
