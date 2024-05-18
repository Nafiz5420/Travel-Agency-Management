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
        <title>View Packages</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script>
        function searchPackages() {
            var searchQuery = document.getElementById('searchInput').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_packages.php?query=' + encodeURIComponent(searchQuery), true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('packagesTable').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>
    </head>
    <body>  <input type="text" id="searchInput" oninput="searchPackages()" placeholder="Search by title...">
    
    <table width="795" align="center" border="1" id="packagesTable">

            <tr align="center">
                <td colspan="6"><h2>View All Packages Here</h2></td>
            </tr>
            <tr align="center">
                <th>Sl.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            include("db.php");

            $get_pack = "select * from packages";
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
        </table>
    </body>
    </html>
    <?php
}
?>