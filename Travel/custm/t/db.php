
<?php

$hostname = "localhost";  
$dbuser = "root"; 
$dbpassword = "";
$dbName = "travel";    


$conn = new mysqli($hostname, $dbuser, $dbpassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertEmergencyRequest($name, $phone, $emergencyType, $details) {
    global $conn;

    $sql = "INSERT INTO emergency_requests (name, phone, emergency_type, details) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $phone, $emergencyType, $details);
    $stmt->execute();
    $stmt->close();
}


function getCats()
{
    global $conn;
    $get_cats = "SELECT * FROM categories";

    $run_cats = mysqli_query($conn, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='booking.php?type=$cat_id' style='background-color: #008CBA;'>$cat_title</a></li>";
    }
}

function getTypes()
{
    global $conn;
    $get_types = "SELECT * FROM types";

    $run_types = mysqli_query($conn, $get_types);

    while ($row_types = mysqli_fetch_array($run_types)) {
        $type_id = $row_types['type_id'];
        $type_title = $row_types['type_title'];

        echo "<li><a href='booking.php?type=$type_id' style='background-color: #008CBA;'>$type_title</a></li>";
    }
}



function getCatPack()
{
    if (isset($_GET['cats'])) {
        $cat_id = $_GET['cats'];
        global $conn;
        $get_cat_pack = "SELECT * FROM packages WHERE package_cat='$cat_id'";

        $run_cat_pack = mysqli_query($conn, $get_cat_pack);

        $count_cats = mysqli_num_rows($run_cat_pack);

        if ($count_cats == 0) {
            echo "<h2 >No packages were found in this category!</h2>";
        }

        while ($row_cat_pack = mysqli_fetch_array($run_cat_pack)) {
            $pack_id = $row_cat_pack['package_id'];
            $pack_cat = $row_cat_pack['package_cat'];
            $pack_type = $row_cat_pack['package_type'];
            $pack_title = $row_cat_pack['package_title'];
            $pack_price = $row_cat_pack['package_price'];
            $pack_image = $row_cat_pack['package_image'];

            echo "
          
            <h3>$pack_title</h3>
            <img src='package_images/$pack_image' width='180' height='180'>
            <p><b> $ $pack_price</b></p>
            <a href='details.php?pack_id=$pack_id' >Review and Rating</a>
            <a href='book.php'><button style='background-color: #008CBA;'>Book</button></a>
            </div>
            ";
        }
    }
}

function getTypePack()
{
    if (isset($_GET['type'])) {
        $type_id = $_GET['type'];
        global $conn;
        $get_type_pack = "SELECT * FROM packages WHERE package_type='$type_id'";

        $run_type_pack = mysqli_query($conn, $get_type_pack);

        $count_types = mysqli_num_rows($run_type_pack);

        if ($count_types == 0) {
            echo "<h2 >No packages were found associated with this type!</h2>";
        }

        while ($row_type_pack = mysqli_fetch_array($run_type_pack)) {
            $pack_id = $row_type_pack['package_id'];
            $pack_cat = $row_type_pack['package_cat'];
            $pack_type = $row_type_pack['package_type'];
            $pack_title = $row_type_pack['package_title'];
            $pack_price = $row_type_pack['package_price'];
            $pack_image = $row_type_pack['package_image'];

            echo "
          
            <h3>$pack_title</h3>
            <img src='package_images/$pack_image' width='180' height='180'>
            <p><b> $ $pack_price</b></p>
            <a href='details.php?pack_id=$pack_id' >Review and Rating</a>
            <a href='book.php?'><button style='background-color:#008CBA;'>Book</button></a>
            </div>
            ";
        }
    }
}
?>