<?php
include("db.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

$destination = $price = $status = "";
$destinationErr = $priceErr = $statusErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["destination"])) {
        $destinationErr = "Destination is required";
    } else {
        $destination = test_input($_POST["destination"]);
    }

    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
        if (!is_numeric($price) || $price <= 0) {
            $priceErr = "Price must be a positive number";
        }
    }

    if (empty($_POST["status"])) {
        $statusErr = "Status is required";
    } else {
        $status = test_input($_POST["status"]);
    }

    if (empty($destinationErr) && empty($priceErr) && empty($statusErr)) {
        // Insert the booking into the database
        $destination = mysqli_real_escape_string($conn, $destination);
        $price = floatval($price);
        $status = mysqli_real_escape_string($conn, $status);

        $sql = "INSERT INTO bookings (booking_date, destination, price, status)
            VALUES (NOW(), '$destination', $price, '$status')";

        if (mysqli_query($conn, $sql)) {
            echo "Booking successfully recorded!";
            header("Location: Booking_history.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Trip</title>
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
                <table>
                <tr>
            <td colspan="3" width="1920" align="center">
                            <h1>Book a Trip</h1>
                            <form method="post" action="book.php" novalidate>
                            <fieldset >
                        <legend>book now!!</legend>
                                <label for="destination">Destination:</label>
                                <input type="text" name="destination" value="<?php echo $destination; ?>" required>
                                <span class="error"><?php echo $destinationErr; ?></span><br>

                                <label for="price">Price:</label>
                                <input type="number" name="price" value="<?php echo $price; ?>" required>
                                <span class="error"><?php echo $priceErr; ?></span><br>

                                <label for="status">Status:</label>
                                <select name="status" required>
                                    <option value="Pending" <?php if ($status === 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="Confirmed" <?php if ($status === 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                    <option value="Cancelled" <?php if ($status === 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                                <span class="error"><?php echo $statusErr; ?></span><br>

                                <input type="submit" value="Book Now">
</fieldset>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <?php include 'footer.php'; ?>
            </td>
        </tr>
    </table>
</body>
</html>