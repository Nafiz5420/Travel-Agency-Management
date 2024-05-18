<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
include("db.php");

if (isset($_GET['delete_cat'])) {
    $delete_id = $_GET['delete_cat'];

    $delete_cat = "DELETE from categories where cat_id='$delete_id'";

    $run_delete = mysqli_query($conn, $delete_cat);
    if ($run_delete) {
        echo "A cat has been DELETED!";
        header("location: Booking_Management.php?view_cats");
        exit();
    }
}
?>
<?php
}
?>