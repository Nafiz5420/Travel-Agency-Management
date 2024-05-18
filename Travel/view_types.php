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
        <title>View types</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <table width="795" align="center" border="1">
            <tr align="center">
                <td colspan="4"><h2>View All types Here</h2></td>
            </tr>
            <tr align="center">
                <th>type ID</th>
                <th>type Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            include("db.php");

            $get_type = "select * from types";
            $run_type = mysqli_query($conn, $get_type);

            $i = 0;

            while ($row_type = mysqli_fetch_array($run_type)) {
                $type_id = $row_type['type_id'];
                $type_title = $row_type['type_title'];
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $type_title; ?></td>
                    <td><a href="edit_type.php?edit_type=<?php echo $type_id; ?>">Edit</a></td>
                    <td><a href="delete_type.php?delete_type=<?php echo $type_id; ?>">Delete</a></td>
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