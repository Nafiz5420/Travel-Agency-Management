<?php<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
include("db.php");

if (isset($_GET['delete_type'])) {
    $delete_id = $_GET['delete_type'];

    $delete_type = "delete from types where type_id='$delete_id'";

    $run_delete = mysqli_query($conn, $delete_type);

    if ($run_delete) {
        echo "A types has been DELETED!";
        header("location: Booking_Management.php?view_types");
        exit();
}}
?>
<?php
}
?>