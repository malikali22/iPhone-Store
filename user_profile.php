<?php include 'partials/header.php'; ?>

<?php

$alert = false;

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM cart WHERE user_email = '$user_email'";
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
            <div class="card" style="height: 200px;">
                <!-- <div class="card-header">
                    <h4 class="text-center">Hi&nbsp;<?= $_SESSION['f_name'] ?>!</h4>
                </div> -->
                <div class="card-body px-5 d-flex justify-content-center flex-column">
                    <a href="./user_profile.php" class="btn btn-outline-primary d-block">Profile</a><br>
                    <a href="./user_wishlist.php" class="btn btn-outline-primary mt-2 d-block">WishList</a>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <!-- <div class="container"> -->
            <!-- <div class="table-responsive"> -->
            <table class="table table-bordered table-hover table-striped text-center mb-0">
                <thead>
                    <tr>
                        <td colspan="7">
                            <div class="welcome_div">
                                <h4 class="mt-3">Hi <?php echo $_SESSION['f_name'] ?>!</h4>
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>First Name : </b><?php echo $_SESSION['f_name'] ?></li>
                                <li class="list-group-item"><b>Last Name : </b><?php echo $_SESSION['l_name'] ?></li>
                                <li class="list-group-item"><b>Email : </b><?php echo $_SESSION['email'] ?></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        <!-- </div> -->
        <!-- </div> -->
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