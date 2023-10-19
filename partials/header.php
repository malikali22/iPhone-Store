<?php include 'partials/db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone Store</title>
    <link rel="icon" href="assets/images/icons/logo_icon-removebg.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/4f9f8dc3ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }

        .wrapper {
            min-height: 100vh;
        }
    </style>
    

</head>

<?php
session_start();

if (!isset($_SESSION['email'])) {
    $num = mt_rand("1000", "9999");
    $random_alphabets = "abcxyz";
    $random_string = str_shuffle($random_alphabets);
    $random_string = substr($random_string, 0, 2);
    $random_email = "user" . $num . $random_string . "@email.com";
    $_SESSION['email'] = $random_email;
    $_SESSION['f_name'] = "user";
}

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM cart WHERE user_email = '$user_email'";
$result = $conn->query($sql);

$_sql = "SELECT * FROM wishlist WHERE user_email = '$user_email'";
$_result = $conn->query($_sql);

$_sql_footer = "SELECT DISTINCT product_catagory FROM products;";
$_result_footer = $conn->query($_sql_footer);
?>

<body style="background-color: #f2f2f2; ">

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/images/icons/logo_icon-removebg.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
            </a>
            <a class="navbar-brand" href="index.php">iPHONE STORE</a>
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
    <div class="wrapper">