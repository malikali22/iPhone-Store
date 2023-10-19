<?php include 'partials/db_connect.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPHONE STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4f9f8dc3ae.js" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        .container {
            width: 1170px;
            margin: 50px auto 50px auto;
            padding: 0 12px 20px 12px;
            background-color: rgb(227, 227, 227);
        }

        /* .card-header {
            font-size: 30px;
            text-align: center;
            background-color: rgb(255, 255, 255);
            width: 1170px;
            padding: 10px 0 10px 0;
            margin-left: -12px;
        } */

        .checkout_header {
            margin: 25px 0 12px 15px;
            padding-top: 20px;
        }

        .checkout {
            /* margin: 25px 0 12px 18px; */
            font-weight: 500;
        }

        .main_caption {
            /* margin: 0 0 18px 18px; */
            margin: 0;

            font-weight: 500;
        }

        .sign_in_container {
            display: flex;
            justify-content: right;
            align-items: end;
        }

        .sign_in {
            width: 120px;
            /* height: 60px; */
            margin: 0 10px;
        }

        .sign_in>a>span {
            color: black;
            padding-left: 2px;
        }

        /* .sign_in_icon {
            width: 16px;
        } */

        .main {
            display: flex;
            justify-content: space-evenly;
            /* align-items: center; */
            margin: 0;
            padding: 0;
        }

        .form_cotainer {
            display: grid;
            grid-template-columns: auto auto;
            column-gap: 30px;
        }

        .form-lable {
            font-size: 14px;
            font-weight: 500;
        }

        .checkout_card_headers {
            margin-bottom: 20px;
            font-weight: 500;
        }

        .shipping_address,
        .shipping_method_div,
        .order_summery,
        .payment_method_div {
            width: 575px;
            padding: 10px;
        }

        .radio-box-container>.row {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .radio-box-container>.row>span {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .radio-box-container>div>span {
            font-size: 14px;
        }

        .Bank_transfer_payment_checkbox {
            margin: 10px;
            padding: 10px 50px;
        }

        .Bank_transfer_payment_checkbox>label {
            margin-left: 10px;
        }

        .order_summery_container {
            padding: 0 10px;
        }

        .price_summery {
            display: grid;
            grid-template-columns: auto auto;
            justify-content: space-between;
        }

        .order_total {
            display: flex;
            justify-content: space-between;

        }

        .submit_btn_container {
            display: flex;
            justify-content: end;
            margin: 30px 0 10px 0;
        }

        .my-animation {
            animation: my-animation 0.5s ease-in-out;
        }

        @keyframes my-animation {
            0% {
                /* transform: translateY(-100%); */
                opacity: 0;
            }

            100% {
                /* transform: translateY(0%); */
                opacity: 1;
            }
        }
    </style>

</head>

<?php

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM cart WHERE user_email = '$user_email'";
$result = $conn->query($sql);

$_sql = "SELECT * FROM wishlist WHERE user_email = '$user_email'";
$_result = $conn->query($_sql);

if (!$_SESSION['email']) {
    header('Location: auth/login.php');
}

?>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/images/icons/logo_icon.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
            </a>
            <a class="navbar-brand" href="index.php">IPHONE STORE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="all_products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="catagories.php">Catagories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php"><i class="fas fa-shopping-cart">&nbsp;<span style="background-color: red;" class=" px-1 rounded "><?php echo $result->num_rows ?></span></i></a>
                    </li>
                    <?php if ($_SESSION['f_name'] == "user") { ?>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block active" href="#" data-bs-toggle="dropdown">
                            <span><i class="fas fa-sign-in"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="auth/login.php">Login</a>
                        </div>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block active" href="#" data-bs-toggle="dropdown">
                                <span><?= $_SESSION['f_name'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="user_profile.php">Profile</a>
                                <a style="display: flex; justify-content: space-between;" class="dropdown-item justify-content-space-between align-items-center" href="user_wishlist.php">
                                    <span>WishList</span>
                                    <?php if ($_result->num_rows > 0) { ?>
                                    <span style="background-color: red; height: 22px; padding: 0 4px;" class=" rounded text-white fw-bold"><?php echo $_result->num_rows ?></span>
                                    <?php } ?>
                                </a>
                                <hr class="mb-0 mt-1">
                                <a class="dropdown-item" href="auth/logout.php">Log out</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>


    <?php
    $alert = false;

    $items = array();
    $grand_total = 0;
    $all_items = '';

    $sql = "SELECT CONCAT(product_name, '(', quantity, ')') AS ItemQty, total_price FROM cart WHERE user_email = '$user_email'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $items[] = $row['ItemQty'];
        $grand_total += $row['total_price'];
    }
    $all_items = implode(", ", $items);

    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        $type = $_SESSION['type'];
        $alert_title = $_SESSION['alert_title'];
        $alert_message = $_SESSION['alert_message'];
    }


    ?>

    <?php include './partials/flash_messages.php';
    // session_destroy();
    ?>


    <div class="container">
        <!-- <div class="card-header">Mobitools</div> -->
        <div class="card-body">
            <div class="checkout_header">
                <h1 class="checkout">Checkout</h1>
                <p class="main_caption">Fill out the following details to complete your order</p>
            </div>


            <!-- <div class="sign_in_container">
                <span class="sign_in">
                    <a href="#" class="btn btn-outline-light">
                        <span><i class="fas fa-sign-in"></i>&nbsp;&nbsp;Sign In</span>
                    </a>
                </span>
            </div> -->


            <div class="main">
                <div class="shipping">
                    <div class="shipping_address">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="checkout_card_headers">Shipping Address</h5>

                                <form class="form_cotainer" action="action.php" method="POST">
                                    <span>
                                        <label for="email" class="form-lable">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control mb-3" required>
                                    </span>

                                    <span>
                                        <label for="f_name" class="form-lable">First Name</label>
                                        <input type="text" name="f_name" id="f_name" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="l_name" class="form-lable">Last Name</label>
                                        <input type="text" name="l_name" id="l_name" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="company" class="form-lable">Company</label>
                                        <input type="text" name="company" id="company" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="street_address_1" class="form-lable">Street Address: Line 1</label>
                                        <input type="text" name="street_address_1" id="street_address_1" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="street_address_2" class="form-lable">Street Address: Line 2</label>
                                        <input type="text" name="street_address_2" id="street_address_2" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="country" class="form-lable">Country</label>
                                        <input type="text" name="country" id="country" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="city" class="form-lable">City</label>
                                        <input type="text" name="city" id="city" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="zip_code" class="form-lable">Zip/Postal Code</label>
                                        <input type="text" name="zip_code" id="zip_code" class="form-control mb-3" required>
                                    </span>
                                    <span>
                                        <label for="phone_number" class="form-lable">Phone Number</label>
                                        <input type="number" name="phone_number" id="phone_number" class="form-control mb-3" required>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="shipping_method_div">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="checkout_card_headers">Shipping Method</h5>

                                <div class="radio-box-container">
                                    <div class="row">
                                        <span class="col-2">
                                            <input type="radio" name="shipping_method" class="shipping_method" id="free_delivery" value="free_delivery" checked required>
                                        </span>
                                        <label class="col-3" for="free_delivery">
                                            $0.00
                                        </label>
                                        <label class="col-3" for="free_delivery">
                                            1-2 Days
                                        </label>
                                        <label class="col-3" for="free_delivery">
                                            Free Delivery
                                        </label>
                                    </div>

                                </div>
                                <hr>
                                <div class="radio-box-container">
                                    <div class="row">
                                        <span class="col-2">
                                            <input type="radio" name="shipping_method" class="shipping_method" id="fast_delivery" value="fast_delivery" required>
                                        </span>
                                        <label class="col-3" for="fast_delivery">
                                            $4.50
                                        </label>
                                        <label class="col-3" for="fast_delivery">
                                            Within 24 Hours
                                        </label>
                                        <label class="col-3" for="fast_delivery">
                                            Fast Delivery
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment">
                    <div class="payment_method_div">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="checkout_card_headers">Payment Method</h5>
                                <div class="radio-box-container">
                                    <div class="row">
                                        <!-- <span class=""> -->
                                        <input class="col-2 payment_method" type="radio" name="payment_method" id="pay_pal" value="pay_pal" required>
                                        <!-- </span> -->
                                        <label class="col-3" for="pay_pal">
                                            <img src="./assets/images/others/paypal-img.png" alt="">
                                        </label>
                                        <label class="col-6" for="pay_pal">
                                            PayPal Express Checkout
                                        </label>
                                        <div class="px-5 mt-3">
                                            <!-- <button name="submit">submit</button> -->
                                            <div id="paypal-button-container" class="pay_pal_btn d-none"></div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="mt-0">
                                <div class="radio-box-container">
                                    <div class="row">
                                        <!-- <span class=""> -->
                                        <input class="col-2 payment_method" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" checked required>
                                        <!-- </span> -->
                                        <label class="col-9" for="cash_on_delivery">
                                            Cash on delivery
                                        </label>
                                    </div>
                                    <!-- <div class="cash_on_delivery_checkbox COD_checkbox text-center mt-3">
                                        <input class="" type="checkbox" value="" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            My billing and shipping address are the same
                                        </label>
                                    </div> -->
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="order_summery">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="checkout_card_headers">Price Summary</h5>

                                <div class="order_summery_container">
                                    <div class="price_summery">
                                        <div>Item(s) Price</div>
                                        <div>$<span id="grand_total"><?php echo $grand_total ?></span></div>
                                        <div>Shipping</div>
                                        <div id="shipping_choosed">$0.00</div>
                                        <!-- <div>Tax</div>
                                        <div>$1.50</div> -->
                                    </div>
                                    <hr>
                                    <div class="order_total">
                                        <div><b>Total</div>
                                        <!-- Hidden Total price -->
                                        <input type="hidden" id="final_price_hidden" name="final_price" value="">
                                        <div id="final_price">$<?php echo $grand_total ?></b></div>
                                    </div>
                                </div>
                                <div class="submit_btn_container">
                                    <input type="submit" name="submit" class="btn btn-outline-secondary" value="Place your order"></input>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AaJcCUn5rHjSDvQg_dT_2c91w_V33PCQUVBB9OJqyVUCN1FemTm1TXsoOz51BtHTOqOV2j7ZnzHw2UhL&currency=USD"></script>

    <script>
        paypal.Buttons({

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?= $grand_total ?>,
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {

                    var email = $('#email').val();
                    var f_name = $('#f_name').val();
                    var l_name = $('#l_name').val();
                    var company = $('#company').val();
                    var street_address_1 = $('#street_address_1').val();
                    var street_address_2 = $('#street_address_2').val();
                    var country = $('#country').val();
                    var city = $('#city').val();
                    var zip_code = $('#zip_code').val();
                    var phone_number = $('#phone_number').val();
                    var shipping_method = $('.shipping_method').val();
                    var payment_method = $('.payment_method').val();
                    var final_price = $('#final_price_hidden').val();

                    data = {
                        'email': email,
                        'f_name': f_name,
                        'l_name': l_name,
                        'company': company,
                        'street_address_1': street_address_1,
                        'street_address_2': street_address_2,
                        'country': country,
                        'city': city,
                        'zip_code': zip_code,
                        'phone_number': phone_number,
                        'shipping_method': shipping_method,
                        'payment_method': payment_method,
                        'final_price': final_price,
                        'payment_status': 'Paid',
                        'submit': true,
                    }

                    $.ajax({
                        method: "POST",
                        url: "action.php",
                        data: data,
                        success: function(response) {
                            window.location.href = "order_summary.php";
                        }
                    })


                });

            },

        }).render('#paypal-button-container');
    </script>

    <script>
        // Custom JS
        let freeDelivery = document.getElementById('free_delivery');
        let fastDelivery = document.getElementById('fast_delivery');
        let shippingChoosed = document.getElementById('shipping_choosed');
        let grandTotal = document.getElementById('grand_total').innerHTML;
        let finalPriceHidden = document.getElementById('final_price_hidden');
        let finalPrice = document.getElementById('final_price');
        finalPriceHidden.value = grandTotal;

        freeDelivery.addEventListener('click', function() {
            shippingChoosed.innerHTML = `$0.00`;
            let sum = parseInt(grandTotal) + 0.00;
            finalPrice.innerHTML = `<b>$` + sum + `</b>`;
            finalPriceHidden.value = sum;

        })
        fastDelivery.addEventListener('click', function() {
            shippingChoosed.innerHTML = `$4.50`;
            let sum = parseInt(grandTotal) + 4.50;
            finalPrice.innerHTML = `<b>$` + sum + `</b>`;
            finalPriceHidden.value = sum;

        })

        let CODContainer = document.getElementById('cash_on_delivery');
        let payPalContainer = document.getElementById('pay_pal');
        let payPalBtn = document.querySelector('.pay_pal_btn');
        // let CODCheckbox = document.querySelector('.COD_checkbox');

        payPalContainer.addEventListener('click', function() {
            payPalBtn.classList.remove("d-none");
            payPalBtn.classList.add('my-animation');
            // CODCheckbox.classList.add("d-none");

        });

        CODContainer.addEventListener('click', function() {
            payPalBtn.classList.add("d-none");
            payPalBtn.classList.remove('my-animation');
            // CODCheckbox.classList.remove("d-none");
            // CODCheckbox.classList.add('my-animation');
        })
    </script>


</body>

</html>