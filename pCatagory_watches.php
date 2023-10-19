<?php include 'partials/header.php'; ?>

<?php

$alert = false;




$sql = "SELECT * FROM products";
$result = $conn->query($sql);

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


<div class="container my-5">
    <div class="mb-5 d-flex justify-content-center">
        <form class="d-flex align-middle col-lg-6" role="search">
            <input class="form-control me-2" style="height: 45px;" type="search" placeholder="I'm looking for..." aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3  mb-3 ">
                <div class="card h-100">
                    <img style="background-color: #b0b0b0;" src="assets/images/products/<?php echo $row['product_image_path'] ?>" class="card-img-top img-fluid  p-5" alt="Product Image" style="size: 170px;">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                        <h5 class="cart-text text-center text-primary">$<?php echo number_format($row['product_price'], 2) ?></h5>
                    </div>

                    <div class="card-footer text-center">
                        <a href="action.php?add_cart_item_id=<?php echo $row['id'] ?>" id="add-to-cart-btn" class="btn btn-outline-primary  w-75 p-2"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Add to cart</a>
                        <a href="action.php?add_wishlist_item_id=<?php echo $row['id'] ?>" class="btn btn-outline-danger px-2"><i class="fas fa-heart" style="font-size: 1.5rem;"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>




<?php include 'partials/footer.php'; ?>