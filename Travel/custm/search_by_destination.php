<?php
include("db.php");

if(isset($_GET['destination'])) {
    $destination = mysqli_real_escape_string($conn, $_GET['destination']);
    $sql = "SELECT * FROM bookings WHERE destination LIKE '%$destination%'";
    $result = mysqli_query($conn, $sql);

   
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Booking Date</th>";
    echo "<th>Destination</th>";
    echo "<th>Price</th>";
    echo "<th>Status</th>";
    echo "</tr>";

    while($row = mysqli_fetch_array($result)) {
        echo "<tr align='left'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['booking_date'] . "</td>";
        echo "<td align='center'>" . $row['destination'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }
}
?>
