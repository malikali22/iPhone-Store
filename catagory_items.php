<?php include 'partials/header.php'; ?>

<style>
    #card-link {
        text-decoration: none;
        color: inherit;
        background-color: transparent;
    }

    #p-card:hover {
        box-shadow: 0 0 5px 2px gray;
        transition: box-shadow 0.2s 0.1s;
        
    }
    #p-card:not(:hover) {
        box-shadow: none;
        transition: box-shadow 1s;
    }

    #card-img:hover {
        padding: 37px !important;
        transition: padding 0.7s ease-in-out;
    }

    #card-img:not(:hover) {
        padding: 48px !important;
        transition: padding 1s;
    }
</style>

<?php

$alert = false;

if (isset($_GET['product_catagory'])) {
    $_SESSION['product_catagory'] = $_GET['product_catagory'];
    
    // $product_catagory = $_GET['product_catagory'];
}

$product_catagory = $_SESSION['product_catagory'];

$sql = "SELECT * FROM products WHERE product_catagory = '$product_catagory'";
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


<div class="container mb-5" style="margin-top: 100px;">
    <button onclick="window.history.back()" class="btn btn-outline-primary mb-2"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3  mb-3 ">
                <a href="./product_description.php?id=<?= $row['id'] ?>" id="card-link">
                    <div class="card h-100" id="p-card">
                        <img id="card-img" style="background-color: #b0b0b0;" src="assets/images/products/<?php echo $row['product_image_path'] ?>" class="card-img-top img-fluid  p-5" alt="Product Image" style="size: 170px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                            <p class="cart-text text-center text-primary" style="font-size: 18px;">$<?php echo number_format($row['product_price'], 2) ?></p>
                        </div>

                        <div class="card-footer text-center">
                            <a href="action.php?add_cart_item_id=<?php echo $row['id'] ?>" id="add-to-cart-btn" class="btn btn-outline-primary  w-75 p-2"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Add to cart</a>
                            <a href="action.php?add_wishlist_item_id=<?php echo $row['id'] ?>" class="btn btn-outline-danger px-2"><i class="fas fa-heart" style="font-size: 1.5rem;"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>



<?php include 'partials/footer.php'; ?>