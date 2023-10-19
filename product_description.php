<?php include 'partials/header.php'; ?>

<?php

$alert = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM products WHERE id = '$id'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $type = $_SESSION['type'];
    $alert_title = $_SESSION['alert_title'];
    $alert_message = $_SESSION['alert_message'];
}

?>
<?php include './partials/flash_messages.php';

$_SESSION['alert'] = false;
$_SESSION['type'] = false;
$_SESSION['alert_title'] = false;
$_SESSION['alert_message'] = false;
?>


<div class="container" style="margin-top: 130px;">
    <div>
        <button onclick="window.history.back()" class="btn btn-outline-primary mb-2"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
        <div class="row ">
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="card">
                    <img style="background-color: #b0b0b0;" src="assets/images/products/<?php echo $data['product_image_path'] ?>" class="card-img-top img-fluid  p-5" alt="Product Image">
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-5">
                <div class="card">
                    <div class="card-header text-center py-2">
                        <h4 class="card-title"><b><?= $data['product_name'] ?></b></h4>
                        <p class="m-0">Catagory: <a class="text-capitalize" href="catagory_items.php"><?= $data['product_catagory'] ?></a></p>
                    </div>
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center my-3">
                            <span><b>Price:</b></span>&nbsp;&nbsp;&nbsp;
                            <h3 class="cart-text">$<?php echo number_format($data['product_price'], 2) ?></h3>
                        </div>
                        <span>
                            <a href="action.php?add_cart_item_id=<?php echo $data['id'] ?>" id="add-to-cart-btn" class="btn btn-primary p-2"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Add to cart</a>
                        </span>

                        <ul class="my-4">
                            <li>
                                <b>Brand</b>&nbsp;&nbsp;Apple
                            </li>
                            <li>
                                <b>Model Name</b>&nbsp;&nbsp;<?= $data['product_name'] ?>
                            </li>
                            <li>
                                <b>Color</b>&nbsp;&nbsp;<?= $data['product_color'] ?>
                            </li>
                            <?php
                            if ($data['product_catagory'] == 'Macbook') {

                                $split_string = explode("/", $data['product_storage']);

                                $RAM = $split_string[0];
                                $SSD = $split_string[1];
                            ?>
                                <li>
                                    <b>RAM</b>&nbsp;&nbsp;<?= $RAM ?>&nbsp;GB
                                </li>
                                <li>
                                    <b>SSD</b>&nbsp;&nbsp;<?= $SSD ?>&nbsp;GB
                                </li>
                            <?php } ?>
                            <?php
                            if ($data['product_catagory'] == 'iPhone' || $data['product_catagory'] == 'iPad') { ?>
                                <li>
                                    <b>Storage</b>&nbsp;&nbsp;<?= $data['product_storage'] ?>&nbsp;GB
                                </li>
                            <?php } ?>
                        </ul>

                        <h3>About this product</h3>

                        <ul class="my-4">
                            <li>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, provident.</span>
                            </li>
                            <li>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, provident.</span>
                            </li>
                            <li>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, provident.</span>
                            </li>
                            <li>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, provident.</span>
                            </li>
                        </ul>

                    </div>

                    <!-- <div class="card-footer text-center">

                </div> -->
                </div>
            </div>
        </div>
    </div>

</div>



<?php include 'partials/footer.php'; ?>