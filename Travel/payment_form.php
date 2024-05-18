<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for live validation
            document.getElementById('amount').addEventListener('input', validateAmount);
            document.getElementById('card_number').addEventListener('input', validateCardNumber);
            document.getElementById('card_holder').addEventListener('input', validateCardHolder);
        });

        function validateAmount() {
            var amount = document.getElementById('amount').value;
            var errorSpan = document.getElementById('amountError');
            if (!amount || amount <= 0) {
                errorSpan.textContent = 'Please enter a valid positive amount.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateCardNumber() {
            var cardNumber = document.getElementById('card_number').value;
            var errorSpan = document.getElementById('cardNumberError');
            if (!cardNumber) {
                errorSpan.textContent = 'Credit Card Number is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateCardHolder() {
            var cardHolder = document.getElementById('card_holder').value;
            var errorSpan = document.getElementById('cardHolderError');
            if (!cardHolder) {
                errorSpan.textContent = 'Cardholder Name is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateForm() {
            // Call validation functions
            validateAmount();
            validateCardNumber();
            validateCardHolder();

            // Check for any validation messages
            var errors = document.querySelectorAll('.error');
            for (var i = 0; i < errors.length; i++) {
                if (errors[i].textContent !== '') {
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Make a Payment</h1>

    <?php
    $error_messages = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
        $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
        $card_holder = filter_input(INPUT_POST, 'card_holder', FILTER_SANITIZE_STRING);

        if (empty($amount) || empty($card_number) || empty($card_holder)) {
            $error_messages['required'] = "All fields are required.";
        } else {
            if (!$amount || $amount <= 0) {
                $error_messages['amount'] = "Please enter a valid positive amount.";
            } else {
                $payment_status = 'Completed';

                include("db.php"); 

                $insert_sql = "INSERT INTO payment_transactions (amount, card_number, card_holder, payment_status)
                            VALUES (?, ?, ?, '$payment_status')";

                $stmt = mysqli_prepare($conn, $insert_sql);

                mysqli_stmt_bind_param($stmt, "dss", $amount, $card_number, $card_holder);

                if (mysqli_stmt_execute($stmt)) {
                    $confirmation_message = "Payment successful. Thank you!";
                } else {
                    $error_messages['database'] = "Error: " . mysqli_error($conn);
                }

     
                mysqli_stmt_close($stmt);

                mysqli_close($conn);
            }
        }
    }
    ?>

<form action="Payment_Gateway.php?payment_form" method="POST" onsubmit="return validateForm()" novalidate>
        <?php if (isset($error_messages['required']) || isset($error_messages['amount'])) { ?>
            <table border="1">
                <tr>
                    <td><?php echo $error_messages['required'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td><?php echo $error_messages['amount'] ?? ''; ?></td>
                </tr>
            </table>
        <?php } ?>
        <table border="1">
            <tr>
                <td>
                    <label for="amount">Amount (USD):</label>
                    <input type="number" name="amount" id="amount" required>
                    <span id="amountError" class="error"></span><br>
                    <label for="card_number">Credit Card Number:</label>
                    <input type="text" name="card_number" id="card_number" required>
                    <span id="cardNumberError" class="error"></span><br>
                    <label for="card_holder">Cardholder Name:</label>
                    <input type="text" name="card_holder" id="card_holder" required>
                    <span id="cardHolderError" class="error"></span>
                    <button type="submit" name="submit">Submit Payment</button>
                </td>
            </tr>
        </table>
    </form>

    <?php if (isset($error_messages['database'])) { ?>
        <table border="1">
            <tr>
                <td><?php echo $error_messages['database']; ?></td>
            </tr>
        </table>
    <?php } elseif (isset($confirmation_message)) { ?>
        <table border="1">
            <tr>
                <td><?php echo $confirmation_message; ?></td>
            </tr>
        </table>
    <?php } ?>
</body>
</html>