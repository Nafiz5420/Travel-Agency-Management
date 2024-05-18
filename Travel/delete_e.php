<?php
include("db.php");

if (isset($_GET['delete_e'])) {
    $delete_id = $_GET['delete_e'];

    $delete_e = "delete from employees where em_id='$delete_id'";

    $run_delete = mysqli_query($conn, $delete_e);

    if ($run_delete) {
        echo "A employee has been DELETED!";
        header("location: user_Management.php?view_employees");
        exit();
    }
}
?>