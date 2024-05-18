<?php
include("db.php");
//session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Insert Category</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form action="" method="post" novalidate>
            <table align="center" border="1">
                <tr>
                    <td align="left"><b>Insert new Category:</b></td>
                    <td align="right"><input type="text" name="new_cat" required=""></td>
                </tr>
               
                <tr>
                    <td colspan="2" align="right"><input type="submit" name="add_cat" value="Add Category"></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['add_cat'])) {
            // Server-side validation
            $new_cat = mysqli_real_escape_string($conn, $_POST['new_cat']);

            if (empty($new_cat)) {
                echo "Category name cannot be empty!";
            } else {
                $insert_cat = "INSERT INTO categories (cat_title) VALUES ('$new_cat')";
                $run_cat = mysqli_query($conn, $insert_cat);

                if ($run_cat) {
                    echo "New CATEGORY has been INSERTED successfully!";
                    echo "<a href='index.php?view_cats'>Go back</a>";
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