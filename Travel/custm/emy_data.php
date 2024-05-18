<?php
if (empty($errors)) {
    
    include('db.php');

   
    $sql = "INSERT INTO emergency_requests (name, phone, emergency_type, details) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $phone, $emergencyType, $details);
    $stmt->execute();
    $stmt->close();

    echo "<h2>Thank you, $name, for submitting the Emergency Assistance Form.</h2>";
    echo "<p>We will review your request and take appropriate action.</p>";

    $conn->close();
}
?>