
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


function getCats() {
    global $conn;
    $get_cats = "SELECT * FROM categories";
    $run_cats = mysqli_query($conn, $get_cats);

    echo "<ul class='categories'>";
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='booking.php?type=$cat_id'>$cat_title</a></li>";
    }
    echo "</ul>";
}

function getTypes() {
    global $conn;
    $get_types = "SELECT * FROM types";
    $run_types = mysqli_query($conn, $get_types);

    echo "<ul class='types'>";
    while ($row_types = mysqli_fetch_array($run_types)) {
        $type_id = $row_types['type_id'];
        $type_title = $row_types['type_title'];
        echo "<li><a href='booking.php?type=$type_id'>$type_title</a></li>";
    }
    echo "</ul>";
}

function getCatPack() {
    if (isset($_GET['cats'])) {
        $cat_id = $_GET['cats'];
        global $conn;
        $get_cat_pack = "SELECT * FROM packages WHERE package_cat='$cat_id'";
        $run_cat_pack = mysqli_query($conn, $get_cat_pack);
        $count_cats = mysqli_num_rows($run_cat_pack);

        if ($count_cats == 0) {
            echo "<h2>No packages were found in this category!</h2>";
        }

        while ($row_cat_pack = mysqli_fetch_array($run_cat_pack)) {
            displayPackage($row_cat_pack);
        }
    }
}

function getTypePack() {
    if (isset($_GET['type'])) {
        $type_id = $_GET['type'];
        global $conn;
        $get_type_pack = "SELECT * FROM packages WHERE package_type='$type_id'";
        $run_type_pack = mysqli_query($conn, $get_type_pack);
        $count_types = mysqli_num_rows($run_type_pack);

        if ($count_types == 0) {
            echo "<h2>No packages were found associated with this type!</h2>";
        }

        while ($row_type_pack = mysqli_fetch_array($run_type_pack)) {
            displayPackage($row_type_pack);
        }
    }
}

function displayPackage($package) {
    $pack_id = $package['package_id'];
    $pack_title = $package['package_title'];
    $pack_price = $package['package_price'];
    $pack_image = $package['package_image'];

    echo "
        <div class='package'>
            <h3>$pack_title</h3>
            <img src='package_images/$pack_image' alt='Package image' class='package-image'>
            <p class='price'><b>$ $pack_price</b></p>
            <a href='details.php?pack_id=$pack_id' class='details-link'>Review and Rating</a>
            <a href='book.php?' class='book-button'>Book</a>
        </div>
    ";
}
?>
<style>
body {
    font-family: Arial, sans-serif;
}

ul.categories, ul.types {
    list-style-type: none;
    padding: 0;
}

ul.categories li a, ul.types li a {
    display: block;
    background-color: #008CBA;
    color: white;
    padding: 10px;
    text-decoration: none;
    margin-bottom: 5px;
}

ul.categories li a:hover, ul.types li a:hover {
    background-color: #005f73;
}

.package {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    text-align: center;
}

.package-image {
    width: 180px;
    height: 180px;
    border: 1px solid #ddd;
    padding: 5px;
}

.price {
    font-size: 1.2em;
    margin: 10px 0;
}

.details-link, .book-button {
    display: inline-block;
    background-color: #008CBA;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    margin: 5px;
    border-radius: 5px;
}

.book-button {
    border: none;
    cursor: pointer;
}

.details-link:hover, .book-button:hover {
    background-color: #005f73;
}
</style>