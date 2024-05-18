<?php
include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel Bird: Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table>
    
    <tr>
        <td>
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
        <td>
            
            <table >
                <tr>
                    <td>
                       
                        <table >
                         
                        </table>
                       
                    </td>
                </tr>
                <tr>
                    <td>
                      
                        <table>
                            <?php
                            if (isset($_GET['pack_id'])) {
                                $package_id = $_GET['pack_id'];

                                $get_pack = "select * from packages where package_id='$package_id'";
                                $run_pack = mysqli_query($conn, $get_pack);

                                while ($row_pack = mysqli_fetch_array($run_pack)) {
                                    $pack_id = $row_pack['package_id'];
                                    $pack_title = $row_pack['package_title'];
                                    $pack_price = $row_pack['package_price'];
                                    $pack_image = $row_pack['package_image'];
                                    $pack_desc = $row_pack['package_desc'];

                                    echo "
                                    <tr>
                                        <td >
                                            <h3 >$pack_title</h3>
                                            <img src='package_images/$pack_image' width='400' height='300'>
                                            <p><b>Cost $ $pack_price</b></p>
                                            <p>$pack_desc</p>
                                            <a href='booking.php' >Go Back</a>
                                            <a href='book.php?pack_id=$pack_id'>
                                                <button >Book</button>
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </table>
                      
                    </td>
                </tr>
            </table>
          
        </td>
    </tr>

    <tr>
        <td>
            <?php include "footer.php"; ?>
        </td>
    </tr>
    
</table>

</body>
</html>