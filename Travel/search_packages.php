<?php
include("db.php");

$query = isset($_GET['query']) ? $_GET['query'] : '';

$get_pack = "SELECT * FROM packages WHERE package_title LIKE '%$query%'";
$run_pack = mysqli_query($conn, $get_pack);

$i = 0;

while ($row_pack = mysqli_fetch_array($run_pack)) {
  
    $pack_id = $row_pack['package_id'];
    $pack_title = $row_pack['package_title'];
    $pack_image = $row_pack['package_image'];
    $pack_price = $row_pack['package_price'];
    $i++;
    ?>
    <tr align="center">
        <td><?php echo $i; ?></td>
        <td><?php echo $pack_title; ?></td>
        <td><img src="package_images/<?php echo $pack_image; ?>" width="40" height="40"></td>
        <td><?php echo $pack_price; ?></td>
        <td><a href="edit_pack.php?edit_pack=<?php echo $pack_id; ?>">Edit</a></td>
        <td><a href="delete_pack.php?delete_pack=<?php echo $pack_id; ?>">Delete</a></td>
        <td></td>
    </tr>
    <?php
}
?>
