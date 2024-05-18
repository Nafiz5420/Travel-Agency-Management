<?php
include("db.php");
//session_start(); 

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Insert Type</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form action="" method="post" novalidate>
            <table align="center" border="1">
                <tr>
                    <td>Insert new Type:</td>
                    <td><input type="text" name="new_type" required=""></td>
                </tr>
                <tr>
                    <td align="right"><input type="submit" name="add_type" value="Add Type"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['add_type'])) {
          
            $new_type = mysqli_real_escape_string($conn, $_POST['new_type']);

            if (empty($new_type)) {
                echo "Type name cannot be empty!";
            } else {
                $insert_type = "INSERT INTO types (type_title) VALUES ('$new_type')";
                $run_type = mysqli_query($conn, $insert_type);

                if ($run_type) {
                    echo "New type has been inserted successfully!";
                    header("location: Booking_Management.php?view_types");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
        ?>
    </body>
    </html>
    <?php
}
?>