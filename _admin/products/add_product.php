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
    $product_row = $result->fetch_assoc();
    if ($result->num_rows > 0) {

        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'warning';
        $_SESSION['alert_title'] = "Fail!";
        $_SESSION['alert_message'] = "Product already added";
    } else {
        move_uploaded_file($product_image_tmp, "../assets/images/products/" . $product_image_path);

        $sql = "INSERT INTO products (product_name, product_color, product_storage, product_image_path, product_catagory, product_description, avalible_quantity, product_price, product_code)
        VALUES ('$product_name', '$product_color', '$product_storage', '$product_image_path', '$product_catagory', '$product_description', '$avalible_quantity', '$product_price','$product_code');";

        $conn->query($sql);

        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'success';
        $_SESSION['alert_title'] = "Success!";
        $_SESSION['alert_message'] = "Product successfully added";
    }
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
$_SESSION['type'] = false;
$_SESSION['alert_title'] = false;
$_SESSION['alert_message'] = false;
?>


<div class="container my-5">
    <div class="">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="checkout">Add Product</h3>
            </div>
            <div class="card-body">
                <form class="form_cotainer" action="add_product.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <label for="product_catagory" class="form-lable required">Catagory</label>
                        <div class="col-md-7">
                            <select class="form-select mb-3" id="product_catagory" name="product_catagory">
                                <option value="">--Select Catagory--</option>
                                <?php
                                $_sql = "SELECT DISTINCT product_catagory FROM products;";
                                $_result = $conn->query($_sql);
                                while ($_row = $_result->fetch_assoc()) { ?>
                                    <option value="<?= $_row['product_catagory'] ?>"><span><?= $_row['product_catagory'] ?></span></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-5 ">
                            <input type="text" name="product_catagory_custom" id="product_catagory" class="form-control mb-3" placeholder="Add New...">
                        </div>
                    </div>

                    <label for="product_image" class="form-lable">Add image</label>
                    <input type="file" accept="image/*" name="product_image" id="product_image" class="form-control mb-3" required>

                    <label for="product_name" class="form-lable">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control mb-3" required>

                    <label for="product_color" class="form-lable">Add Color</label>
                    <input type="text" name="product_color" id="product_color" class="form-control mb-3" required>

                    <label for="product_storage" class="form-lable">Storage</label>
                    <input type="text" name="product_storage" id="product_storage" class="form-control mb-3" required placeholder="No need! Leave it empty">

                    <label for="product_description" class="form-lable">Description</label>
                    <textarea class="form-control mb-3" name="product_description" id="product_description" rows="3"></textarea>

                    <label for="avalible_quantity" class="form-lable">Quantity</label>
                    <input type="number" name="avalible_quantity" id="avalible_quantity" class="form-control mb-3" required>

                    <label for="product_price" class="form-lable">Add price</label>
                    <input type="number" name="product_price" id="product_price" class="form-control mb-3" required>

                    <label for="product_code" class="form-lable">Product code</label>
                    <input type="text" name="product_code" id="product_code" class="form-control mb-3" required>

                    <div class="submit_btn_container mt-5">
                        <input type="submit" name="submit" class="btn btn-outline-secondary" value="Add product"></input>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include './partials/admin_footer.php'; ?>