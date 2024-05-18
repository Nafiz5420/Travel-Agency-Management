<?php
include("db.php");
if (isset($_POST['update_employee'])) {
    
    $update_id = $_GET['edit_em'];
    $employee_name = $_POST['em_name'];
    $employee_email = $_POST['em_email'];
    $employee_designation = $_POST['em_designation'];
    $employee_location = $_POST['em_location'];
    $employee_address = $_POST['em_address'];
    $employee_contact = $_POST['em_contact'];

    $update_employee = "update employees set em_name='$employee_name', em_email='$employee_email', em_designation='$employee_designation', em_location='$employee_location', em_address='$employee_address', em_contact='$employee_contact' where em_id='$update_id'";

    $run_pack = mysqli_query($conn, $update_employee);

    if ($run_pack) {
        echo "emp has been UPDATED successfully!";
        header("Location: user_Management.php?view_employees");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Employee</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
    <?php
    if (isset($_GET['edit_em'])) {
        $get_id = $_GET['edit_em'];
        $get_emp = "select * from employees where em_id='$get_id'";
        $run_emp = mysqli_query($conn, $get_emp);
        $row_emp = mysqli_fetch_array($run_emp);

        $emp_id = $row_emp['em_id'];
        $emp_name = $row_emp['em_name'];
        $emp_email = $row_emp['em_email'];
        $emp_designation = $row_emp['em_designation'];
        $emp_location = $row_emp['em_location'];
        $emp_address = $row_emp['em_address'];
        $emp_contact = $row_emp['em_contact'];
        ?>
        <form action="" method="post" enctype="multipart/form-data" novalidate>
            <table align="center" width="795" border=2px >
                <tr align="center">
                    <td colspan="7"><h2 >Insert New Employee</h2>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Name:</b></td>
                    <td><input type="text" name="emp_name" value="<?php echo $emp_name; ?>" size="40"></td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Email:</b></td>
                    <td><input type="email" name="emp_email" value="<?php echo $emp_email; ?>" size="40"></td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Designation:</b></td>
                    <td><input type="text" name="emp_designation" value="<?php echo $emp_designation; ?>"></td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Location:</b></td>
                    <td><input type="text" name="emp_location" value="<?php echo $emp_location; ?>"></td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Address:</b></td>
                    <td><textarea name="emp_address" cols="40" rows="10"><?php echo $emp_address; ?></textarea></td>
                </tr>
                <tr>
                    <td align="right"><b>Employee Contact:</b></td>
                    <td><input type="text" name="emp_contact" value="<?php echo $emp_contact; ?>" size="30"></textarea>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="7"><input  type="submit"
                                           name="update_employee" value="Update Employee"></td>
                </tr>
            </table>
        </form>
        <?php
    }
    ?>
</body>
</html>