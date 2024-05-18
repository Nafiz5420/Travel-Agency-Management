<?php
if (!isset($_SESSION['username'])) {
    echo "You are not an Admin!";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Employees</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <table width="795" align="center" border="1">
            <tr align="center">
                <td colspan="8"><h2>View All Employees</h2></td>
            </tr>
            <tr align="center">
                <th>Sl.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Location</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            include("db.php");
            $get_c = "select * from employees";
            $run_c = mysqli_query($conn, $get_c);
            $i = 0;

            while ($row_c = mysqli_fetch_array($run_c)) {
                $e_id = $row_c['em_id'];
                $e_name = $row_c['em_name'];
                $e_email = $row_c['em_email'];
                $e_designation = $row_c['em_designation'];
                $e_location = $row_c['em_location'];
                $e_address = $row_c['em_address'];
                $e_contact = $row_c['em_contact'];
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $e_name; ?></td>
                    <td><?php echo $e_email; ?></td>
                    <td><?php echo $e_designation; ?></td>
                    <td><?php echo $e_location; ?></td>
                    <td><?php echo $e_address; ?></td>
                    <td><?php echo $e_contact; ?></td>
                    <td><a href="edit_emp.php?edit_em=<?php echo $e_id; ?>">Edit</a></td>
                    <td><a href="delete_e.php?delete_e=<?php echo $e_id; ?>">Delete</a></td>
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