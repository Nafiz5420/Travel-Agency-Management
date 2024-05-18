<?php
include("db.php");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_cat = mysqli_real_escape_string($conn, $_POST['package_cat']);
    $package_type = mysqli_real_escape_string($conn, $_POST['package_type']);
    $package_title = mysqli_real_escape_string($conn, $_POST['package_title']);
    $package_price = mysqli_real_escape_string($conn, $_POST['package_price']);
    $package_desc = mysqli_real_escape_string($conn, $_POST['package_desc']);
    $package_keywords = mysqli_real_escape_string($conn, $_POST['package_keywords']);

    if (empty($package_cat)) {
        $errors['package_cat'] = "Category is required.";
    }

    if (empty($package_type)) {
        $errors['package_type'] = "Type is required.";
    }

    if (empty($package_title)) {
        $errors['package_title'] = "Title is required.";
    }

    if (empty($package_price)) {
        $errors['package_price'] = "Price is required.";
    } elseif (!is_numeric($package_price)) {
        $errors['package_price'] = "Price must be a numeric value.";
    }

    if (empty($package_desc)) {
        $errors['package_desc'] = "Description is required.";
    }

    if (empty($package_keywords)) {
        $errors['package_keywords'] = "Keywords are required.";
    }

    if (empty($_FILES['package_image']['name'])) {
        $errors['package_image'] = "Please select an image file.";
    }


    if (empty($errors)) {
        $package_image = $_FILES['package_image']['name'];
        $package_image_tmp = $_FILES['package_image']['tmp_name'];

        move_uploaded_file($package_image_tmp, "package_images/$package_image");

        $insert_package_sql = "INSERT INTO packages (package_cat, package_type, package_title, package_price, package_desc, package_image, package_keywords) VALUES ('$package_cat', '$package_type', '$package_title', '$package_price', '$package_desc', '$package_image', '$package_keywords')";

        $insert_package = mysqli_query($conn, $insert_package_sql);

        if ($insert_package) {
            echo "Package has been inserted!";
            header("location: Content_Management.php?view_packages");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inserting Package</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validatePackageTitle() {
            const packageTitle = document.getElementById('package_title').value;
            const errorSpan = document.getElementById('package_title_error');
            if (!packageTitle) {
                errorSpan.textContent = 'Package Title is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackageCat() {
            const packageCat = document.getElementById('package_cat').value;
            const errorSpan = document.getElementById('package_cat_error');
            if (!packageCat) {
                errorSpan.textContent = 'Package Category is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackageType() {
            const packageType = document.getElementById('package_type').value;
            const errorSpan = document.getElementById('package_type_error');
            if (!packageType) {
                errorSpan.textContent = 'Package Type is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackageImage() {
            const packageImage = document.getElementById('package_image').value;
            const errorSpan = document.getElementById('package_image_error');
            if (!packageImage) {
                errorSpan.textContent = 'Please select an image file.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackagePrice() {
            const packagePrice = document.getElementById('package_price').value;
            const errorSpan = document.getElementById('package_price_error');
            if (!packagePrice) {
                errorSpan.textContent = 'Package Price is required.';
            } else if (isNaN(packagePrice)) {
                errorSpan.textContent = 'Price must be a numeric value.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackageDesc() {
            const packageDesc = document.getElementById('package_desc').value;
            const errorSpan = document.getElementById('package_desc_error');
            if (!packageDesc) {
                errorSpan.textContent = 'Package Description is required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function validatePackageKeywords() {
            const packageKeywords = document.getElementById('package_keywords').value;
            const errorSpan = document.getElementById('package_keywords_error');
            if (!packageKeywords) {
                errorSpan.textContent = 'Package Keywords are required.';
            } else {
                errorSpan.textContent = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('package_title').addEventListener('input', validatePackageTitle);
            document.getElementById('package_cat').addEventListener('input', validatePackageCat);
            document.getElementById('package_type').addEventListener('input', validatePackageType);
            document.getElementById('package_image').addEventListener('input', validatePackageImage);
            document.getElementById('package_price').addEventListener('input', validatePackagePrice);
            document.getElementById('package_desc').addEventListener('input', validatePackageDesc);
            document.getElementById('package_keywords').addEventListener('input', validatePackageKeywords);
        });
    </script>
</head>

<body>
    <form action="Content_Management.php?insert_package" method="post" enctype="multipart/form-data" novalidate>
        <table align="center" width="795" border="2">
            <tr align="center">
                <td colspan="2">
                    <h2>Insert New Package Here</h2>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Title:</b></td>
                <td>
                    <input type="text" name="package_title" id="package_title" size="60" value="<?php echo isset($package_title) ? $package_title : ''; ?>" oninput="validatePackageTitle()">
                    <span id="package_title_error" class="error"></span>
                    <?php if (isset($errors['package_title'])) echo "<span>{$errors['package_title']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Category:</b></td>
                <td>
                    <select name="package_cat" id="package_cat" oninput="validatePackageCat()"><?php
                    $get_cats_sql = "SELECT * FROM categories";
                        $run_cats = mysqli_query($conn, $get_cats_sql);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                            $selected = ($package_cat == $cat_id) ? 'selected' : '';

                            echo "<option value='$cat_id' $selected>$cat_title</option>";
                        }
                        ?>
                    </select>
                    <span id="package_cat_error" class="error"></span>
                    <?php if (isset($errors['package_cat'])) echo "<span>{$errors['package_cat']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Type:</b></td>
                <td>
                    <select name="package_type" id="package_type" oninput="validatePackageType()">
                        <option>Select a type</option>
                        <?php
                        $get_types_sql = "SELECT * FROM types";
                        $run_types = mysqli_query($conn, $get_types_sql);

                        while ($row_types = mysqli_fetch_array($run_types)) {
                            $type_id = $row_types['type_id'];
                            $type_title = $row_types['type_title'];
                            $selected = ($package_type == $type_id) ? 'selected' : '';

                            echo "<option value='$type_id' $selected>$type_title</option>";
                        }
                        ?>
                    </select>
                    <span id="package_type_error" class="error"></span>
                    <?php if (isset($errors['package_type'])) echo "<span>{$errors['package_type']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Image:</b></td>
                <td>
                    <input type="file" name="package_image" id="package_image" oninput="validatePackageImage()">
                    <span id="package_image_error" class="error"></span>
                    <?php if (isset($errors['package_image'])) echo "<span>{$errors['package_image']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Price:</b></td>
                <td>
                    <input type="text" name="package_price" id="package_price" value="<?php echo isset($package_price) ? $package_price : ''; ?>" oninput="validatePackagePrice()">
                    <span id="package_price_error" class="error"></span>
                    <?php if (isset($errors['package_price'])) echo "<span>{$errors['package_price']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Description:</b></td>
                <td>
                    <textarea name="package_desc" id="package_desc" cols="20" rows="10" oninput="validatePackageDesc()"><?php echo isset($package_desc) ? $package_desc : ''; ?></textarea>
                    <span id="package_desc_error" class="error"></span>
                    <?php if (isset($errors['package_desc'])) echo "<span>{$errors['package_desc']}</span>"; ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Package Keywords:</b></td>
                <td>
                    <input type="text" name="package_keywords" id="package_keywords" size="70" value="<?php echo isset($package_keywords) ? $package_keywords : ''; ?>" oninput="validatePackageKeywords()">
                    <span id="package_keywords_error" class="error"></span>
                    <?php if (isset($errors['package_keywords'])) echo "<span>{$errors['package_keywords']}</span>"; ?>
                </td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" name="insert_package" value="Insert Package"></td>
            </tr>
        </table>
    </form>
</body>

</html>