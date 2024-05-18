<?php
if (!isset($_SESSION['username'])) {
    echo "You are not an Admin!";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Customers</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <table width="795" align="center" border="2">
            <tr align="center">
                <td colspan="5"><h2>View All users Here</h2></td>
            </tr>
            <tr align="center">
                <th>Sl.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Delete</th>
            </tr>
            <?php
            include("db.php");

            $get_c = "SELECT * FROM users";
            $run_c = mysqli_query($conn, $get_c);

            $i = 0;

            while ($row_c = mysqli_fetch_array($run_c)) {
                $c_id = $row_c['user_id'];
                $c_name = $row_c['user_name'];
                $c_email = $row_c['user_email'];
                $c_image = $row_c['user_image'];
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $c_name; ?></td>
                    <td><?php echo $c_email; ?></td>
                    <td><img src="../user_images/<?php echo $c_image; ?>" width="50" height="50"></td>
                    <td><a href="delete_c.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
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
