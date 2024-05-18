<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("amount").addEventListener("input", validateAmount);
            document.getElementById("card_number").addEventListener("input", validateCardNumber);
        };

        function validateAmount() {
            var amount = document.getElementById("amount").value;
            var errorSpan = document.getElementById("amountError");

            if (amount === "" || isNaN(amount) || amount <= 0) {
                errorSpan.innerHTML = "Please enter a valid positive amount.";
                return false;
            } else {
                errorSpan.innerHTML = "";
                return true;
            }
        }

        function validateCardNumber() {
            var cardNumber = document.getElementById("card_number").value;
            var errorSpan = document.getElementById("cardNumberError");

            if (cardNumber === "" || isNaN(cardNumber) || cardNumber.length !== 16) {
                errorSpan.innerHTML = "Please enter a valid 16-digit card number.";
                return false;
            } else {
                errorSpan.innerHTML = "";
                return true;
            }
        }
    </script>
</head>
<body>
    <?php 
    include("db.php");
    session_start();

    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }

    $amountError = $cardNumberError = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST['amount'];
        $card_number = $_POST['card_number'];
        $payment_method = $_POST['payment_method'];

        if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
            $amountError = "Please enter a valid positive amount.";
        }

        if (empty($card_number) || !is_numeric($card_number) || strlen($card_number) !== 16) {
            $cardNumberError = "Please enter a valid 16-digit card number.";
        }

        if (empty($amountError) && empty($cardNumberError)) {
            $sql = "INSERT INTO payments (user_id, amount, payment_method, card_number , status)
                    VALUES (1, $amount, '$payment_method', '$card_number',  'pending')";

            if ($conn->query($sql) === TRUE) {
                $successMessage = "Payment processed successfully.";
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
    ?>

    <?php require 'headline.php'; ?>
    <tr>
        <td>
            <h2>Make a Payment</h2>
            <?php
            if (isset($successMessage)) {
                echo "<p>$successMessage</p>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <label for="amount">Amount:</label>
                <input type="text" name="amount" id="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : ''; ?>" required>
                <span class="error" id="amountError"><?php echo $amountError; ?></span><br>

                <label for="card_number">Credit Card Number:</label>
                <input type="text" name="card_number" id="card_number" value="<?php echo isset($_POST['card_number']) ? $_POST['card_number'] : ''; ?>" required>
                <span class="error" id="cardNumberError"><?php echo $cardNumberError; ?></span><br>

                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="e-commerce">E-commerce Payment</option>
                    <option value="digital_wallet">Digital Wallet</option>
                </select><br>

                <input type="submit" value="Submit Payment">
            </form>
        </td>
    </tr>
    <?php include "footer.php"; ?>
</body>
</html>
