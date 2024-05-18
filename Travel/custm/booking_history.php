<?php
include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking History</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table border="0">
    <tr>
        <td>
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="searchDestination">Search by Destination:</label>
            <input type="text" id="searchDestination" onkeyup="searchByDestination(this.value)" />
            
            <table id="bookingTable" align="center" border="1">
                <tr>
                    <th>ID</th>
                    <th>Booking Date</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                <?php
                
                $sql = "SELECT * FROM bookings";
                $result = mysqli_query($conn, $sql);

                while ($row_c = mysqli_fetch_array($result)) {
                    echo "<tr align='left'>";
                    echo "<td>" . $row_c['id'] . "</td>";
                    echo "<td>" . $row_c['booking_date'] . "</td>";
                    echo "<td align='center'>" . $row_c['destination'] . "</td>";
                    echo "<td>" . $row_c['price'] . "</td>";
                    echo "<td>" . $row_c['status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <?php include 'footer.php'; ?>
        </td>
    </tr>
</table>

<script>
function searchByDestination(str) {
    if (str.length == 0) {
        document.getElementById("bookingTable").innerHTML = "";
        return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("bookingTable").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "search_by_destination.php?destination=" + encodeURIComponent(str));
    xhttp.send();
}
</script>

</body>
</html>
