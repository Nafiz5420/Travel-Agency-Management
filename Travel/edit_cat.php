<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    include("db.php");

    if (isset($_GET['edit_cat'])) {
        $cat_id = mysqli_real_escape_string($conn, $_GET['edit_cat']);
        $get_cat = "SELECT * FROM categories WHERE cat_id='$cat_id'";
        $run_cat = mysqli_query($conn, $get_cat);

        if ($run_cat && mysqli_num_rows($run_cat) > 0) {
            $row_cat = mysqli_fetch_array($run_cat);
            $cat_id = $row_cat['cat_id'];
            $cat_title = $row_cat['cat_title'];
        } else {
           
            echo "Category not found.";
            exit();
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Category</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form action="" method="post" novalidate>
            <table align="center">
                <tr>
                    <td align="left"><b>Update Category:</b></td>
                    <td align="right"><input type="text" name="new_cat" value="<?php echo htmlspecialchars($cat_title); ?>"></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="update_cat" value="Update Category"></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['update_cat'])) {
            $update_id = $cat_id;
            $new_cat = mysqli_real_escape_string($conn, $_POST['new_cat']);
            $update_cat = "UPDATE categories SET cat_title='$new_cat' WHERE cat_id='$update_id'";
            $run_cat = mysqli_query($conn, $update_cat);

            if ($run_cat) {
                echo '<p>CATEGORY has been UPDATED successfully!</p>';
                header("Location: Booking_Management.php?view_cats");
                exit();
            } else {
                echo "Error updating category: " . mysqli_error($conn);
            }
        }
        ?>
    </body>
    </html>
    <?php
}
?>