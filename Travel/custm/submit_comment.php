<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

   
    $errors = [];

    
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors['username'] = "Username must be at least 3 characters long.";
    }

   
    if (empty($comment)) {
        $errors['comment'] = "Comment cannot be empty.";
    }

   
    if (count($errors) === 0) {
       
        $stmt = $conn->prepare("INSERT INTO comments (username, comment) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $comment);
        
        if ($stmt->execute()) {
            echo "Comment added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
       
        foreach ($errors as $error) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }
    }

    $conn->close();
}

?>
