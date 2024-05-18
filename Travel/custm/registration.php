<?php
session_start();
$funameError = $genderError = $religionError = $bloodgroupError = $emailError = $phoneError = $divisionError = $countryError = $addressError = $postcodeError = $usnameError = $passwordError = $conpasswordError = "";

$funame = $selectedGender = $bloodgroup = $religion = $email = $phone = $division = $country = $address = $postcode = $usname = $password = $conpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require_once "db.php";

    $funame = isset($_POST["funame"]) ? input_data($_POST["funame"]) : '';
    $selectedGender = isset($_POST['gender']) ? input_data($_POST['gender']) : '';
    $bloodgroup = isset($_POST["bloodgroup"]) ? input_data($_POST["bloodgroup"]) : '';
    $religion = isset($_POST["religion"]) ? input_data($_POST["religion"]) : '';
    $email = isset($_POST["email"]) ? input_data($_POST["email"]) : '';
    $phone = isset($_POST["phone"]) ? input_data($_POST["phone"]) : '';
    $division = isset($_POST["division"]) ? input_data($_POST["division"]) : '';
    $country = isset($_POST["Country"]) ? input_data($_POST["Country"]) : '';
    $address = isset($_POST["address"]) ? input_data($_POST["address"]) : '';
    $postcode = isset($_POST["postcode"]) ? input_data($_POST["postcode"]) : '';
    $usname = isset($_POST["usname"]) ? input_data($_POST["usname"]) : '';
    $password = isset($_POST["password"]) ? input_data($_POST["password"]) : '';
    $conpassword = isset($_POST["conpassword"]) ? input_data($_POST["conpassword"]) : '';

    if (empty($funame)) {
        $funameError = "Name is empty.";
    }
    
    if (empty($selectedGender)) {
        $genderError = "Gender is empty.";
    }

    if (empty($bloodgroup)) {
        $bloodgroupError = "Blood Group is empty.";
    }
    if (empty($religion)) {
        $religionError = "Religion is empty.";
    }

    if (empty($email)) {
        $emailError = "Email is empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    if (empty($phone)) {
        $phoneError = "Phone/Mobile number is empty.";
    }

    if (empty($division)) {
        $divisionError = "Division is empty.";
    }

    if (empty($country)) {
        $countryError = "Country is empty.";
    }

    if (empty($address)) {
        $addressError = "Address is empty.";
    }
    if (empty($postcode)) {
        $postcodeError = "Post code is empty.";
    }

    if (empty($usname)) {
        $usnameError = "Username is empty.";
    } elseif (strlen($usname) > 5 || preg_match('/[^A-Za-z0-9]/', $usname)) {
        $usnameError = "Username must be 5 characters or less and can only contain letters and numbers.";
    }

    if (empty($password)) {
        $passwordError = "Password is empty.";
    } elseif ($password !== $conpassword || strlen($password) < 8) {
        $passwordError = "Passwords must match and be at least 8 characters.";
    }

    if (empty($conpassword)) {
        $conpasswordError = "Confirm Password is empty.";
    }

    if (empty($funameError) && empty($genderError) && empty($bloodgroupError) && empty($religionError) && empty($emailError) && empty($phoneError) && empty($divisionError) && empty($countryError) && empty($addressError) && empty($postcodeError) && empty($usnameError) && empty($passwordError) && empty($conpasswordError)) {
      
        $sql = "INSERT INTO users (funame, gender, bloodgroup, religion, email, phone, division, country, address, postcode, usname, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

       
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $funame, $selectedGender, $bloodgroup, $religion, $email, $phone, $division, $country, $address, $postcode, $usname, $password);

            if (mysqli_stmt_execute($stmt)) {
              
                header("Location: login.php");
                exit();
            } else {
              
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            die("Something went wrong");
        }
    }

       
}


  






function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include('registration.html');
?>