<?php
include './partials/admin_header.php';
include './partials/admin_sideBar.php';
?>

<?php

if (!isset($_SESSION['admin_l_name'])) {
    header('Location: admin_auth/login.php');
}



$sql = "SELECT * FROM products";
$products_result = $conn->query($sql);

$sql = "SELECT * FROM orders";
$orders_result = $conn->query($sql);

$sql = "SELECT * FROM users";
$users_result = $conn->query($sql);

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

<div class="" style="background-color: #eaeced; height: 100vh; padding: 70px 60px;">
    <div class="container-fluid p-0">

        <p class=" mb-3 text-center" style="font-variant: small-caps; font-size: 22px;">Welcome <?= $_SESSION['admin_f_name'] ?>!</p>

        <div class="row">
            <div class="col-12">
                <div class="card" style="border: none; box-shadow: 0px 0px 20px 0px #dbdbdb;">
                    <table class="table border m-0">
                        <thead>
                            <tr class="">

                                <th class="col-3 text-center">Total Products</th>
                                <th class="col-3 text-center">Total Order Placed</th>
                                <th class="col-3 text-center">Total Users Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="text-center"><?= $products_result -> num_rows ?></td>
                                <td class="text-center"><?= $orders_result -> num_rows ?></td>
                                <td class="text-center"><?= $users_result -> num_rows ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './partials/admin_footer.php'; ?>