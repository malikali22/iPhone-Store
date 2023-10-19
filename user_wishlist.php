<?php include 'partials/header.php'; ?>

<?php

$alert = false;

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM wishlist WHERE user_email = '$user_email'";
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


<div class="mx-5 mt-5">
    <div class="row align-items-center">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Hi&nbsp;<?= $_SESSION['f_name'] ?>!</h4>
                </div>
                <div class="card-body px-5">
                    <a href="./user_profile.php" class="btn btn-outline-primary d-block">Profile</a><br>
                    <a href="./user_wishlist.php" class="btn btn-outline-primary mt-2 d-block">WishList</a>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="container">
                <div class="table-responsive mt-5">

                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center p-1">Your WishList!</h4>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Storage</th>
                                <th>Price</th>
                                <th>
                                    <a href="action.php?clear_wishlist" class="btn btn-outline-danger p-1 <?php echo ($result->num_rows > 0) ? "" : "disabled"  ?>" onclick="return confirm('Are you sure want to clear your wishlist?')">&nbsp;<i class="fas fa-trash"></i>&nbsp;&nbsp;Clear WishList&nbsp;</a>
                                </th>
                            </tr>
                        </thead>
                        <?php if ($result->num_rows == 0) { ?>
                            <tbody>
                                <tr>
                                    <td colspan="8">
                                        <h5>No item in the wishlist</h5>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } else { ?>
                            <tbody>
                                <?php
                                $i = 1;
                                $grand_total = 0;
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr class="align-middle">

                                        <!-- Hidden inputs -->
                                        <input type="hidden" id="product_id_hidden" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" id="product_count" value="<?php echo $result->num_rows ?>">
                                        <input type="hidden" id="product_price_hidden" value="<?php echo $row['product_price'] ?>">

                                        <td><?php echo $i ?></td>
                                        <td><img class="p-2" style="width: 75px;" src="assets/images/products/<?php echo $row['product_image_path'] ?>"></td>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td><?php echo $row['product_color'] ?></td>
                                        <td><?php echo $row['product_storage'] ?> GB</td>
                                        <td>$<?php echo number_format($row['product_price'], 2) ?></td>
                                        <td>
                                            <a href="action.php?add_wishlist_item_to_cart=<?php echo $row['product_code'] ?>" class="text-success"><i class="fas fa-cart-plus"></i></a>&nbsp;&nbsp;
                                            <a href="action.php?remove_wishlist_item=<?php echo $row['id'] ?>" class="text-danger" onclick="return confirm('Are you sure want to remove this item from your wishlist?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr class="align-middle">
                                    <!-- <td colspan="6"><a href="index.php" class="btn btn-outline-success p-1 m-2">&nbsp;<i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping&nbsp;</a></td> -->
                                    <td colspan="7"><a href="action.php?all_items_to_cart" class="btn btn-success p-2 m-1">&nbsp;<i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Add Item(s) to cart&nbsp;</a></td>
                                </tr>
                            </tfoot>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    // $(document).ready(function(){
    //     $(".item-qty").on('change', function(){
    //         var $element = $(this).closest('tr');

    //         var productId = $element.find("#product_id_hidden").val();
    //         var productPrice = $element.find("#product_price_hidden").val();
    //         var qty = $element.find(".item-qty").val();
    //         location.reload(true);

    //         $.ajax({
    //             url: 'action.php',
    //             method: 'post',
    //             cache: false,
    //             data: {qty:qty, productId:productId, productPrice:productPrice},
    //             success: function(response){
    //                 // console.log(response);
    //             }
    //         })
    //     })
    // })
</script>

<?php include 'partials/footer.php'; ?>