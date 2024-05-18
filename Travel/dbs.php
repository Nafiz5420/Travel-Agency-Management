<?php

$hostname = "localhost";  
$dbuser = "root"; 
$dbpassword = "";
$dbName = "travelcomp";    


$conn = new mysqli($hostname, $dbuser, $dbpassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbName", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}




?>