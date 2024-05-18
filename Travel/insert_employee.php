<?php
include("db.php");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $em_name = mysqli_real_escape_string($conn, $_POST['em_name']);
    $em_email = mysqli_real_escape_string($conn, $_POST['em_email']);
    $em_designation = mysqli_real_escape_string($conn, $_POST['em_designation']);
    $em_location = mysqli_real_escape_string($conn, $_POST['em_location']);
    $em_address = mysqli_real_escape_string($conn, $_POST['em_address']);
    $em_contact = mysqli_real_escape_string($conn, $_POST['em_contact']);

    if (empty($em_name)) {
        $errors['em_name'] = "Employee Name is required.";
    }

    if (empty($em_email)) {
        $errors['em_email'] = "Employee Email is required.";
    } elseif (!filter_var($em_email, FILTER_VALIDATE_EMAIL)) {
        $errors['em_email'] = "Invalid email format.";
    }

    if (empty($em_designation)) {
        $errors['em_designation'] = "Employee Designation is required.";
    }

    if (empty($em_location)) {
        $errors['em_location'] = "Employee Location is required.";
    }

    if (empty($em_address)) {
        $errors['em_address'] = "Employee Address is required.";
    }

    if (empty($em_contact)) {
        $errors['em_contact'] = "Employee Contact is required.";
    }

    if (empty($errors)) {
        $insert_employee_query = "INSERT INTO employees (em_name, em_email, em_designation, em_location, em_address, em_contact) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $insert_employee_query);
        
        mysqli_stmt_bind_param($stmt, "ssssss", $em_name, $em_email, $em_designation, $em_location, $em_address, $em_contact);

        if (mysqli_stmt_execute($stmt)) {
            echo "An employee has been inserted!";
            header("location: user_Management.php?insert_employee");
            exit();
        } else {
            echo "Error inserting employee: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inserting Employee</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateEmName() {
            const emName = document.getElementById('em_name').value;
            const errorSpan = document.getElementById('em_name_error');
            if (!emName) {
                errorSpan.textContent = 'Employee Name is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateEmEmail() {
            const emEmail = document.getElementById('em_email').value;
            const errorSpan = document.getElementById('em_email_error');
            if (!emEmail) {
                errorSpan.textContent = 'Employee Email is required.';
            } else if (!emEmail.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                errorSpan.textContent = 'Invalid email format.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateEmDesignation() {
            const emDesignation = document.getElementById('em_designation').value;
            const errorSpan = document.getElementById('em_designation_error');
            if (!emDesignation) {
                errorSpan.textContent = 'Employee Designation is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateEmLocation() {
            const emLocation = document.getElementById('em_location').value;
            const errorSpan = document.getElementById('em_location_error');
            if (!emLocation) {
                errorSpan.textContent = 'Employee Location is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validateEmAddress() {
            const emAddress = document.getElementById('em_address').value;
            const errorSpan = document.getElementById('em_address_error');
            if (!emAddress) {
                errorSpan.textContent = 'Employee Address is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        // Initialize validation on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('em_name').addEventListener('input', validateEmName);
            document.getElementById('em_email').addEventListener('input', validateEmEmail);
            document.getElementById('em_designation').addEventListener('input', validateEmDesignation);
            document.getElementById('em_location').addEventListener('input', validateEmLocation);
            document.getElementById('em_address').addEventListener('input', validateEmAddress);
        });
    </script>
</head>

<body>
    <form action="user_Management.php?insert_employee" method="post" novalidate>
        <table align="center" width="795" border="2">
            <tr align="center">
                <td colspan="7">
                    <h2>Insert New Employee</h2>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Name:</b></td>
                <td><input type="text" name="em_name" id="em_name" size="40" oninput="validateEmName()">
                    <span id="em_name_error" class="error"></span>
                    <?php if (isset($errors['em_name'])) echo "<span>{$errors['em_name']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Email:</b></td>
                <td><input type="email" name="em_email" id="em_email" size="40">
                    <span id="em_email_error" class="error"></span>
                    <?php if (isset($errors['em_email'])) echo "<span>{$errors['em_email']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Designation:</b></td>
                <td><input type="text" name="em_designation" id="em_designation">
                    <span id="em_designation_error" class="error"></span>
                    <?php if (isset($errors['em_designation'])) echo "<span>{$errors['em_designation']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Location:</b></td>
                <td><input type="text" name="em_location" id="em_location">
                    <span id="em_location_error" class="error"></span>
                    <?php if (isset($errors['em_location'])) echo "<span>{$errors['em_location']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Address:</b></td>
                <td><textarea name="em_address" id="em_address" cols="40" rows="10"></textarea>
                    <span id="em_address_error" class="error"></span>
                    <?php if (isset($errors['em_address'])) echo "<span>{$errors['em_address']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Employee Contact:</b></td>
                <td><input type="text" name="em_contact" size="30">
                    <?php if (isset($errors['em_contact'])) echo "<span>{$errors['em_contact']}</span>"; ?>
                </td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" name="insert_post" value="Insert Employee">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
