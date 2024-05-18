<!DOCTYPE html>
<html>
<head>
    <title>Payment History</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Payment History</h1>

    <?php
    include("db.php"); 

    
    $sql = "SELECT * FROM payment_transactions";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      
        echo "<table border='1'>
            <tr>
                <th>SL.</th>
                <th>Amount (USD)</th>
                <th>Credit Card Number</th>
                <th>Cardholder Name</th>
                <th>Payment Status</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row['transaction_id'] . "</td>
                <td>" . $row['amount'] . "</td>
                <td>" . $row['card_number'] . "</td>
                <td>" . $row['card_holder'] . "</td>
                <td>" . $row['payment_status'] . "</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No payment history available.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>