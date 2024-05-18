<?php
include("db.php");

if (isset($_GET['delete_c'])) {
    $delete_id = $_GET['delete_c'];

    $delete_c = "delete from users where user_id='$delete_id'";

    $run_delete = mysqli_query($conn, $delete_c);

    if ($run_delete) {
        echo "A types has been DELETED!";
        header("location: user_Management.php?view_users");
        exit();
    }
}
?>