<?php
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Categories</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <table width="795" align="center" border="1">
            <tr align="center">
                <td colspan="6"><h2>View All Categories Here</h2></td>
            </tr>
            <tr align="center">
                <th>Category ID</th>
                <th>Category Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            include("db.php");
            $get_cat = "select * from categories";
            $run_cat = mysqli_query($conn, $get_cat);

            $i = 0;

            while ($row_cat = mysqli_fetch_array($run_cat)) {
                $cat_id = $row_cat['cat_id'];
                $cat_title = $row_cat['cat_title'];
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $cat_title; ?></td>
                    <td><a href="edit_cat.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
                    <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>

    <?php
}
?>