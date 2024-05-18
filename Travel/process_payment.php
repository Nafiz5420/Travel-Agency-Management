<?php
$error_message = "";
$confirmation_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
    $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
    $card_holder = filter_input(INPUT_POST, 'card_holder', FILTER_SANITIZE_STRING);
    $expiry_date = filter_input(INPUT_POST, 'expiry_date', FILTER_SANITIZE_STRING);
    $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);

    if (empty($amount) || empty($card_number) || empty($card_holder) || empty($expiry_date) || empty($cvv)) {
        $error_message = "All fields are required.";
    } elseif (!$amount || $amount <= 0) {
        $error_message = "Please enter a valid positive amount.";
    } else {
        include("db.php"); 

        $insert_sql = "INSERT INTO payment_transactions (amount, card_number, card_holder, expiry_date, cvv, payment_status)
                    VALUES (?, ?, ?, ?, ?, 'Completed')";

        $stmt = mysqli_prepare($conn, $insert_sql);

        mysqli_stmt_bind_param($stmt, "dssss", $amount, $card_number, $card_holder, $expiry_date, $cvv);

        if (mysqli_stmt_execute($stmt)) {
            $confirmation_message = "Payment successful. Thank you!";
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    }
}
?>