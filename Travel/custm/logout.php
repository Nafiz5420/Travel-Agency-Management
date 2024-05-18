<?php
session_start();
if (isset($_SESSION['username'])) {

    session_unset();


    session_destroy();
    setcookie("remember_username", "", time() - 3600, '/');
}

header("location: login.php");
exit();
?>