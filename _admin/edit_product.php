<?php include './partials/admin_header.php'; ?>
<?php include './partials/admin_sideBar.php'; ?>

<?php

if (!isset($_SESSION['admin_l_name'])) {
    header('Location: admin_auth/login.php');
}

$alert = false;

if (isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $product_color = $_POST['product_color'];
    $product_storage = $_POST['product_storage'];
    $product_catagory = $_POST['product_catagory'];
    $product_catagory_custom = $_POST['product_catagory_custom'];
    $product_description = $_POST['product_description'];
    $avalible_quantity = $_POST['avalible_quantity'];
    $product_price = $_POST['product_price'];
    $product_code = $_POST['product_code'];
    $product_image_path = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    if ($product_catagory == "") {
        $product_catagory = $product_catagory_custom;
    }
    if ($product_catagory == "" && $product_catagory_custom == "") {
        $product_catagory = "iPhone";
    }

    $sql = "SELECT * FROM products WHERE product_code = '$product_code'";
    $result = $conn->query($sql);
    $data = $result -> fetch_assoc();

    $file_path = "../assets/images/products/" .  $data['product_image_path'];
    unlink($file_path);

    move_uploaded_file($product_image_tmp, "../assets/images/products/" . $product_image_path);

    $sql = "UPDATE products SET `product_name` = '$product_name', 
                                `product_color` = '$product_color', 
                                `product_storage` = '$product_storage',
                                `product_catagory` = '$product_catagory',
                                `product_description` = '$product_description',
                                `avalible_quantity` = '$avalible_quantity',
                                `product_price` = '$product_price', 
                                `product_image_path` = '$product_image_path'   
                                WHERE `product_code` = '$product_code';";
    $conn->query($sql);
    
    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Product successfully updated";

    header('Location: products.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

 if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $type = $_SESSION['type'];
    $alert_title = $_SESSION['alert_title'];
    $alert_message = $_SESSION['alert_message'];
}

?>

<?php include '../partials/flash_messages.php';
$_SESSION['alert'] = false;
// $_SESSION['type'] = false;
// $_SESSION['alert_title'] = false;
// $_SESSION['alert_message'] = false;

?>

<div class="container my-5">

    <a href="products.php" class="btn btn-outline-primary mb-2"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
    <div class="card">
        <div class="card-header text-center">
            <h3 class="checkout">Edit Product</h3>
        </div>
        <div class="card-body">
            <form class="form_cotainer" action="edit_product.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <label for="product_catagory" class="form-lable required">Catagory</label>
                    <div class="col-md-10">
                        <select class="form-select mb-3" id="product_catagory" name="product_catagory">
                            <option value="">--Select Catagory--</option>
                            <?php
                            $_sql = "SELECT DISTINCT product_catagory FROM products;";
                            $_result = $conn->query($_sql);
                            while ($_row = $_result->fetch_assoc()) { ?>
                                <option value="<?= $_row['product_catagory'] ?>" <?php echo ($_row['product_catagory'] == $row['product_catagory']) ? "selected" : ""  ?>><span><?= $_row['product_catagory'] ?></span></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="product_catagory_custom" id="product_catagory" class="form-control mb-3" placeholder="Add New...">
                    </div>
                </div>

                <label for="product_image" class="form-lable">Add image</label>
                <input type="file" accept="image/*" name="product_image" id="product_image" class="form-control mb-3" value="<?php echo $row['product_image_path'] ?>" required>

                <label for="product_name" class="form-lable">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control mb-3" value="<?php echo $row['product_name'] ?>" required>

                <label for="product_color" class="form-lable">Add Color</label>
                <input type="text" name="product_color" id="product_color" class="form-control mb-3" value="<?php echo $row['product_color'] ?>" required>

                <label for="product_storage" class="form-lable">Storage</label>
                <input type="text" name="product_storage" id="product_storage" class="form-control mb-3" value="<?php echo $row['product_storage'] ?>" required>

                <label for="product_description" class="form-lable">Description</label>
                <textarea class="form-control mb-3" name="product_description" id="product_description" rows="3" required><?php echo $row['product_description'] ?></textarea>

                <label for="avalible_quantity" class="form-lable">Quantity</label>
                <input type="number" name="avalible_quantity" id="avalible_quantity" class="form-control mb-3" value="<?php echo $row['avalible_quantity'] ?>" required>

                <label for="product_price" class="form-lable">Add price</label>
                <input type="number" name="product_price" id="product_price" class="form-control mb-3" value="<?php echo $row['product_price'] ?>" required>

                <label for="product_code_disabled" class="form-lable">Product code</label>
                <input type="text" name="product_code_disabled" id="product_code_disabled" class="form-control mb-3" value="<?php echo $row['product_code'] ?>" required disabled>

                <!-- hidden input  -->
                <input type="hidden" name="product_code" value="<?php echo $row['product_code'] ?>">


                <div class="submit_btn_container mt-5">
                    <input type="submit" name="submit" class="btn btn-outline-secondary" value="Update product"></input>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include './partials/admin_footer.php'; ?>