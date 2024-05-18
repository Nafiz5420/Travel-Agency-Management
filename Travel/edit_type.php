<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    include("db.php");

    if (isset($_GET['edit_type'])) {
        $type_id = $_GET['edit_type'];
        $get_type = "select * from types where type_id='$type_id'";
        $run_type = mysqli_query($conn, $get_type);
        $row_type = mysqli_fetch_array($run_type);

        $type_id = $row_type['type_id'];
        $type_title = $row_type['type_title'];
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit type</title>
    </head>
    <body>
        <form action="" method="post" novalidate>
            <table align="center">
                <tr>
                    <td align="left"><b>Update type:</b></td>
                    <td align="right"><input type="text" name="new_type" value="<?php echo $type_title; ?>"></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="update_type" value="Update type"></td>
                </tr>
            </table>
        </form>
        <?php
        include("db.php");
        if (isset($_POST['update_type'])) {
            $update_id = $type_id;
            $new_type = $_POST['new_type'];
            $update_type = "update types set type_title='$new_type' where type_id='$update_id'";
            $run_type = mysqli_query($conn, $update_type);

            if ($run_type) {
                echo "type has been UPDATED successfully!";
                header("Location: Booking_Management.php?view_types");
                exit();
            }
        }
        ?>
    </body>
    </html>
    <?php
}
?>