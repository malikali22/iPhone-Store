<?php include 'partials/header.php'; ?>

<style>
    .price_summery {
        display: grid;
        grid-template-columns: auto auto;
        justify-content: space-between;
    }

    .order_total {
        display: flex;
        justify-content: space-between;

    }

    .order_summery_container {
        padding: 0 10px;
    }
</style>

<?php
$alert = false;



// $sql = "SELECT * FROM users WHERE email = '$user_email'";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();

// if ($result->num_rows == 0) {
//     $sql = "SELECT * FROM users WHERE email = ''";
//     $result = $conn->query($sql);
//     $row = $result->fetch_assoc();
// }



// $sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 1;";

$user_email = $_SESSION['email'];

$sql = "SELECT * FROM orders WHERE user_email = '$user_email' ORDER BY created_at DESC LIMIT 1;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$tracking_id = $row['tracking_id'];
$reciver_email = $row['reciver_email'];
$reciver_f_name = $row['reciver_f_name'];
$reciver_l_name = $row['reciver_l_name'];
$street_address_1 = $row['reciver_street_1'];
$street_address_2 = $row['reciver_street_2'];
$city = $row['reciver_city'];
$country = $row['reciver_country'];
$zip_code = $row['reciver_zip_code'];

$full_name = $reciver_f_name . " " . $reciver_l_name;
$address = $street_address_1 . ", " . $street_address_2 . ", " . $city . ", " . $country . ", " . $zip_code;

$items = $row['products'];
$amount_to_pay = $row['amount_to_pay'];
$payment_method_raw = $row['payment_method'];
$payment_method = str_replace("_", " ", $payment_method_raw);
$payment_status = $row['payment_status'];

?>

<?php include './partials/flash_messages.php';
$_SESSION['alert'] = false;
$_SESSION['type'] = false;
$_SESSION['alert_title'] = false;
$_SESSION['alert_message'] = false;
?>

<div class="container mt-5 w-50 p-3 rounded" style="background-color: rgb(227, 227, 227);">
    <h3 class="text-center text-success"><b>Thanks!</b></h3>
    <p class="text-center text-success"><b>Your order placed successfully</b></p>

    <div class="card">
        <div class="card-header text-center">
            <h5>Order Summary</h5>
        </div>
        <div class="card-body">
            <!-- <h5 class="checkout_card_headers">Price Summary</h5> -->
            <div class="order_summery_container">
                <div class="price_summery">
                    <div>Name:</div>
                    <div><?php echo $full_name ?></div>
                    <div>Email:</div>
                    <div><?php echo $reciver_email ?></div>
                    <div>Address:</div>
                    <div><?php echo $address ?></div>
                    <div>Item(s):</div>
                    <div><?php echo $items ?></div>
                    <div>Traciking ID:</div>
                    <div><?php echo $tracking_id ?></div>
                    <div>Total Amount:</div>
                    <div>$<?php echo number_format($amount_to_pay, 2) ?></div>
                    <div>Payment Method:</div>
                    <div class="text-capitalize"><?php echo $payment_method ?></div>
                    <div>Payment Status:</div>
                    <div class="text-capitalize"><?php echo $payment_status ?></div>
                </div>
            </div>
        </div>
        <hr class="mt-0">
    </div>
    <div class="">
        <a href="index.php" class="btn btn-outline-success p-1 mt-2">&nbsp;<i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping&nbsp;</a>
    </div>
</div>


<?php include 'partials/footer.php'; ?>