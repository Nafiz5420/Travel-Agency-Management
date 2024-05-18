<?php
include("db.php"); // Make sure to include your db.php file here
include("LoginController.php");

$loginController = new LoginController(new UserModel($conn));
$loginController->handleLoginRequest();
?>
