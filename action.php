<?php include 'partials/db_connect.php';
session_start();
?>


<?php

// Email verification on register
if (isset($_GET['varification_token'])) {
    $varification_token = $_GET['varification_token'];

    $sql = "UPDATE users SET varification_status = 'Yes' WHERE varification_token = '$varification_token'";
    $conn->query($sql);

    echo "
        <div style='display: flex; justify-content: center;'>
            <div style='text-align: center; margin-top: 50px; background-color: #06a906; padding: 22px; border-radius: 20px; width: 75%;'>
                <h2>Your email has been successfully verifed <a href='auth/login.php'>Login</a></h2>
            </div>
        </div>
        ";
}

// Sreach items
if (isset($_POST['searchTerm'])) {

    $searchTerm = $_POST['searchTerm'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    $html = '';

    if ($result->num_rows > 0) {

        $html = '
                <div class="px-3 pt-3" style="background-color: white; border-radius: 20px;">
                    
                    <div class="row align-items-center" id="searchedProducts">
                    ';
        while ($row = $result->fetch_assoc()) {

            $html .= '<div class="col-sm-6 col-md-4 col-lg-3  mb-3 ">
                        <a href="./product_description.php?id=' . $row['id'] . '" id="card-link">
                            <div class="card h-100" id="p-card">
                                <img id="card-img" style="background-color: #b0b0b0;" src="assets/images/products/' . $row['product_image_path'] . '" class="card-img-top img-fluid  p-5" alt="Product Image" style="size: 170px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $row['product_name'] . '</h5>
                                    <h5 class="cart-text text-center text-primary">$' . number_format($row['product_price'], 2) . '</h5>
                                </div>
    
                                <div class="card-footer text-center">
                                    <a href="action.php?add_cart_item_id=' . $row['id'] . '" id="add-to-cart-btn" class="btn btn-outline-primary  w-75 p-2"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Add to cart</a>
                                    <a href="action.php?add_wishlist_item_id=' . $row['id'] . '" class="btn btn-outline-danger px-2"><i class="fas fa-heart" style="font-size: 1.5rem;"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>';
        }
        $html .= '</div>';
    } else {
        $_sql = "SELECT * FROM pcatagories";
        $_result = $conn->query($_sql);
        if ($searchTerm !== "xyz") {
            $html = '<div class="d-flex justify-content-center">
                    <div class="alert alert-warning alert-dismissible fade show  w-25" role="alert">
                        No product found
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
        }

        while ($_row = $_result->fetch_assoc()) {

            $html .= '
                    
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <a href="./catagory_items.php?product_catagory=' . $_row['product_catagory'] . '" id="card-link">
                            <div class="card h-100" id="p-card">
                                <img id="card-img" style="background-color: #b0b0b0;" src="assets/images/product_profiles/' . $_row['product_profile_img_path'] . '" class="card-img-top img-fluid p-5" alt="Product Image" style="size: 170px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $_row['product_catagory'] . '</h5>
                                </div>
                            </div>
                        </a>
                    </div>';
        }
    }


    echo $html;
}

// Adding item to the cart
if (isset($_GET['add_cart_item_id'])) {


    $id = $_GET['add_cart_item_id'];

    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $user_email = $_SESSION['email'];
    $product_name = $data['product_name'];
    $product_image_path = $data['product_image_path'];
    $product_color = $data['product_color'];
    $product_storage = $data['product_storage'];
    $product_price = $data['product_price'];
    $product_code = $data['product_code'];
    $quantity = 1;
    $total_price = $data['product_price'];

    // $sql = "SELECT * FROM cart WHERE user_email = $user_email";
    // $result = $conn->query($sql);
    // $row = $result->fetch_assoc();

    // if ($row['product_code' == $product_code]) {


    $sql = "SELECT * FROM cart WHERE user_email = '$user_email' AND product_code = '$product_code'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {


        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'warning';
        $_SESSION['alert_title'] = "Fail!";
        $_SESSION['alert_message'] = "Product already added in cart";
    } else {

        $sql = "INSERT INTO cart (user_email, product_name, product_image_path, product_color, product_storage, product_price, product_code, quantity, total_price)
        VALUES ('$user_email', '$product_name', '$product_image_path', '$product_color', '$product_storage', '$product_price', '$product_code', '$quantity', '$total_price');";

        $conn->query($sql);


        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'success';
        $_SESSION['alert_title'] = "Success!";
        $_SESSION['alert_message'] = "Product successfully added to cart";
    }


    // header('Location: index.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Clear all items from cart
if (isset($_GET['clear_cart'])) {
    $user_email = $_SESSION['email'];
    $sql = "DELETE FROM cart WHERE user_email = '$user_email'";
    $conn->query($sql);


    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Cart successfully cleared";
    header('Location: cart.php');
}

// Rewmove item from cart 
if (isset($_GET['remove_cart_item'])) {
    $id = $_GET['remove_cart_item'];
    $sql = "DELETE FROM cart WHERE id = '$id'";
    $conn->query($sql);


    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Item successfully removed";
    header('Location: cart.php');
}

// Adding item to the wishlist
if (isset($_GET['add_wishlist_item_id'])) {

    if ($_SESSION['f_name'] == "user") {
        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'warning';
        $_SESSION['alert_title'] = "";
        $_SESSION['alert_message'] = "Please login first";

        header('Location: auth/login.php');
    } else {
        $id = $_GET['add_wishlist_item_id'];

        $sql = "SELECT * FROM products WHERE id = '$id'";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();

        $user_email = $_SESSION['email'];
        $product_name = $data['product_name'];
        $product_image_path = $data['product_image_path'];
        $product_color = $data['product_color'];
        $product_storage = $data['product_storage'];
        $product_price = $data['product_price'];
        $product_code = $data['product_code'];

        $sql = "SELECT * FROM wishlist WHERE user_email = '$user_email' AND product_code = '$product_code'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'warning';
            $_SESSION['alert_title'] = "Fail!";
            $_SESSION['alert_message'] = "Product already added in your wishlist";
        } else {

            $sql = "INSERT INTO wishlist (user_email, product_name, product_image_path, product_color, product_storage, product_price, product_code)
        VALUES ('$user_email', '$product_name', '$product_image_path', '$product_color', '$product_storage', '$product_price', '$product_code');";

            $conn->query($sql);

            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'success';
            $_SESSION['alert_title'] = "Success!";
            $_SESSION['alert_message'] = "Product added to your wishlist";
        }


        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

// Clear all items from wishlist
if (isset($_GET['clear_wishlist'])) {
    $user_email = $_SESSION['email'];
    $sql = "DELETE FROM wishlist WHERE user_email = '$user_email'";
    $conn->query($sql);


    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Wishlist successfully cleared";
    header('Location: user_wishlist.php');
}

// Rewmove item from wishlist
if (isset($_GET['remove_wishlist_item'])) {
    $id = $_GET['remove_wishlist_item'];
    $sql = "DELETE FROM wishlist WHERE id = '$id'";
    $conn->query($sql);

    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Item successfully removed";
    header('Location: user_wishlist.php');
}

// Adding wishlist item to the cart
if (isset($_GET['add_wishlist_item_to_cart'])) {


    $product_code = $_GET['add_wishlist_item_to_cart'];

    $sql = "SELECT * FROM products WHERE product_code = '$product_code'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $user_email = $_SESSION['email'];
    $product_name = $data['product_name'];
    $product_image_path = $data['product_image_path'];
    $product_color = $data['product_color'];
    $product_storage = $data['product_storage'];
    $product_price = $data['product_price'];
    $product_code = $data['product_code'];
    $quantity = 1;
    $total_price = $data['product_price'];

    $sql = "SELECT * FROM cart WHERE user_email = '$user_email' AND product_code = '$product_code'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {


        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'warning';
        $_SESSION['alert_title'] = "";
        $_SESSION['alert_message'] = "Product already added in cart";
    } else {

        $sql = "INSERT INTO cart (user_email, product_name, product_image_path, product_color, product_storage, product_price, product_code, quantity, total_price)
        VALUES ('$user_email', '$product_name', '$product_image_path', '$product_color', '$product_storage', '$product_price', '$product_code', '$quantity', '$total_price');";

        $conn->query($sql);


        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'success';
        $_SESSION['alert_title'] = "Success!";
        $_SESSION['alert_message'] = "Product successfully added to cart";

        $sql = "DELETE FROM wishlist WHERE product_code = '$product_code'";
        $conn->query($sql);
    }

    header('Location: user_wishlist.php');
}

// Adding all wishlist items to cart
if (isset($_GET['all_items_to_cart'])) {

    $_sql = "SELECT * FROM wishlist";
    $_result = $conn->query($_sql);

    while ($_data = $_result->fetch_assoc()) {

        $user_email = $_SESSION['email'];
        $product_name = $_data['product_name'];
        $product_image_path = $_data['product_image_path'];
        $product_color = $_data['product_color'];
        $product_storage = $_data['product_storage'];
        $product_price = $_data['product_price'];
        $product_code = $_data['product_code'];
        $quantity = 1;
        $total_price = $_data['product_price'];

        $sql = "SELECT * FROM cart WHERE user_email = '$user_email' AND product_code = '$product_code'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'warning';
            $_SESSION['alert_title'] = "";
            $_SESSION['alert_message'] = "These products are already added in cart";
        } else {

            $sql = "INSERT INTO cart (user_email, product_name, product_image_path, product_color, product_storage, product_price, product_code, quantity, total_price)
        VALUES ('$user_email', '$product_name', '$product_image_path', '$product_color', '$product_storage', '$product_price', '$product_code', '$quantity', '$total_price');";

            $conn->query($sql);

            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'success';
            $_SESSION['alert_title'] = "Success!";
            $_SESSION['alert_message'] = "Product successfully added to cart";

            $sql = "DELETE FROM wishlist WHERE product_code = '$product_code'";
            $conn->query($sql);
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Clear all items from database
if (isset($_GET['database_remove_all'])) {
    $sql = "DELETE FROM products";
    $conn->query($sql);

    $directory_path = 'assets/images/products/';

    $files = glob($directory_path . '*');

    foreach ($files as $file) {
        unlink($file);
    }

    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Database successfully cleared";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Rewmove item from database 
if (isset($_GET['database_remove_item_id'])) {
    $id = $_GET['database_remove_item_id'];

    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $file_path = "assets/images/products/" .  $data['product_image_path'];
    unlink($file_path);

    $sql = "DELETE FROM products WHERE id = '$id'";
    $conn->query($sql);

    $_SESSION['alert'] = true;
    $_SESSION['type'] = 'success';
    $_SESSION['alert_title'] = "Success!";
    $_SESSION['alert_message'] = "Item successfully removed";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Dynamically updating quantity into the cart database
if (isset($_POST['qty'])) {

    $product_id = $_POST['productId'];
    $product_price = $_POST['productPrice'];
    $quantity = $_POST['qty'];

    $total_price = $product_price * $quantity;

    $sql = "UPDATE cart SET product_price = '$product_price', quantity = '$quantity', total_price = '$total_price' WHERE   id = '$product_id'";
    $result = $conn->query($sql);
}

// Placing order

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) {


    $tracking_id = mt_rand(100000, 999999);
    $user_email = $_SESSION['email'];
    $reciver_email = $_POST['email'];
    $reciver_f_name = $_POST['f_name'];
    $reciver_l_name = $_POST['l_name'];
    $company = $_POST['company'];
    $street_address_1 = $_POST['street_address_1'];
    $street_address_2 = $_POST['street_address_2'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $phone_number = $_POST['phone_number'];
    $shipping_method = $_POST['shipping_method'];
    $payment_method = $_POST['payment_method'];
    $final_price = $_POST['final_price'];

    if ($payment_method == 'pay_pal') {
        $payment_status = 'paid';
    } else {
        $payment_status = 'pending';
    }

    // Adding user to database
    // $sql = "SELECT * FROM users WHERE email = '$user_email'";
    // $result = $conn->query($sql);

    // if ($_SESSION['email'] == $reciver_email) {

    //     $sql = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', company = '$company', street_address_1 = '$street_address_1', street_address_2 = '$street_address_2', country = '$country', city = '$city', zip_code = '$zip_code', phone_number = '$phone_number' WHERE email = '$user_email';";

    //     $conn->query($sql);
    // } else {

    //     $sql = "INSERT INTO users(email, password,  f_name, l_name, company, street_address_1, street_address_2,  country, city, zip_code,  phone_number)
    //         VALUES('$email', '$user_email', '$f_name', '$l_name', '$company', '$street_address_1', '$street_address_2', '$country', '$city', '$zip_code',  '$phone_number')";

    //     $conn->query($sql);
    // }

    // getting cart items

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

    // Adding order info
    $sql = "INSERT INTO orders(tracking_id, user_email, reciver_email, reciver_f_name, reciver_l_name, reciver_company, reciver_street_1, reciver_street_2,  reciver_country, reciver_city, reciver_zip_code,  reciver_phone_number, shipping_method, payment_method, products, amount_to_pay, payment_status)
            VALUES('$tracking_id', '$user_email','$reciver_email', '$reciver_f_name', '$reciver_l_name', '$company', '$street_address_1', '$street_address_2', '$country', '$city', '$zip_code',  '$phone_number', '$shipping_method', '$payment_method', '$all_items', '$final_price', '$payment_status')";

    $result = $conn->query($sql);

    if ($result) {

        $full_name = $reciver_f_name . " " . $reciver_l_name;
        $address = $street_address_1 . ", " . $street_address_2 . ", " . $city . ", " . $country . ", " . $zip_code;
        $total_amount = "$" . number_format($final_price, 2);
        $_payment_method = str_replace("_", " ", $payment_method);

        

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mail.2.malikali97@gmail.com';                     //SMTP username
            $mail->Password   = 'kcwwbxaucakzokxz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mail.2.malikali97@gmail.com', 'iPhone Store');
            $mail->addAddress($reciver_email, $full_name);     //Add a recipient
            $mail->addReplyTo('mail.2.malikali97@gmail.com', 'iPhone Store');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Order Summary from iPhone Store';
            $mail->Body    = "
                    <div style='width: 500px; background-color: #fafafa; border-radius: 5px;'>
                        <div style='padding: 20px;'>
                            <h3 style='text-align: center;'>Thanks!</h3>
                            <p style='text-align: center;'>Your order placed successfully</p>
                            <hr>
                            <div style='margin-top: 20px;'>
                                <div style='font-weight: bold;'>Order Summary</div>
                                <table style='width: 100%;'>
                                    <tr>
                                        <td>Name</td>
                                        <td>$full_name</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>$reciver_email</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>$address</td>
                                    </tr>
                                    <tr>
                                        <td>Item(s)</td>
                                        <td>$all_items</td>
                                    </tr>
                                    <tr>
                                        <td>Tracking ID</td>
                                        <td>$tracking_id</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>$total_amount</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td style='text-transform: capitalize;'>$_payment_method</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td style='text-transform: capitalize;'>$payment_status</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    ";

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Deleting items from cart after placing order
        $sql = "DELETE FROM cart WHERE user_email = '$user_email'";
        $result = $conn->query($sql);

        // Deleting random users except the one who places the order
        // $sql = "DELETE FROM users 
        //         WHERE created_at < ( 
        //             SELECT created_at FROM users 
        //             ORDER BY created_at DESC 
        //             LIMIT 1 ) 
        //         AND password LIKE 'user%';";
        // $result = $conn->query($sql);

        // Clearing random users cart
        $sql = "DELETE FROM cart WHERE user_email LIKE 'user%';";
        $result = $conn->query($sql);



        if ($payment_method == 'cash_on_delivery') {
            header('Location: order_summary.php');
        }
    } else {
        $_SESSION['alert'] = true;
        $_SESSION['type'] = 'danger';
        $_SESSION['alert_title'] = "Fail!";
        $_SESSION['alert_message'] = "Some error occuring while placing order";
        header('Location: checkout.php');
    }
}

?>

