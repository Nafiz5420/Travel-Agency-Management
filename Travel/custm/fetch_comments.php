<?php
include 'db.php';

$result = $conn->query("SELECT * FROM comments ORDER BY posted_at DESC");

while ($row = $result->fetch_assoc()) {
    echo "<div><strong>" . htmlspecialchars($row['username']) . "</strong>: " . htmlspecialchars($row['comment']) . "</div>";
}

$conn->close();
?>
