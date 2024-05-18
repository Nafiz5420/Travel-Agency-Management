<?php
include("db.php");

if (isset($_GET['delete_pack'])) {
    $delete_id = $_GET['delete_pack'];

    $delete_pack = "DELETE FROM packages WHERE package_id='$delete_id'";

    $run_delete = mysqli_query($conn, $delete_pack);

    if ($run_delete) {
        echo "A package has been DELETED!";
        header("location: Content_Management.php?view_packages");
        exit();
    }
}
?>