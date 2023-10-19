<?php include '../../partials/db_connect.php' ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Register</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 600px;
        }
    </style>
</head>

<body>

    <?php

    session_start();
    $alert = false;
    // $login_error = '';

    // if (isset($_POST['register'])) {

    //     $admin_f_name = $_POST['f_name'];
    //     $admin_l_name = $_POST['l_name'];
    //     $admin_email = $_POST['email'];
    //     $admin_password = $_POST['password'];
    //     $admin_cpassword = $_POST['cpassword'];

    //     if ($admin_password != $admin_cpassword) {

    //         $_SESSION['alert'] = true;
    //         $_SESSION['type'] = 'warning';
    //         $_SESSION['alert_title'] = "Fail!";
    //         $_SESSION['alert_message'] = "Password do not match";
    //     } else {

    //         $sql = "SELECT * FROM admins WHERE admin_email = '$admin_email'";
    //         $result =  $conn->query($sql);

    //         if ($result->num_rows == 0) {

    //             $sql = "INSERT INTO admins(admin_f_name, admin_l_name, admin_email, admin_password)
    //                     VALUES('$admin_f_name', '$admin_l_name', '$admin_email', '$admin_password')";

    //             $conn->query($sql);

    //             $_SESSION['alert'] = true;
    //             $_SESSION['type'] = 'success';
    //             $_SESSION['alert_title'] = "Successfully registered!";
    //             $_SESSION['alert_message'] = 'Please login';

    //             header('Location: login.php');
    //         } else {

    //             $_SESSION['alert'] = true;
    //             $_SESSION['type'] = 'warning';
    //             $_SESSION['alert_title'] = "Fail!";
    //             $_SESSION['alert_message'] = 'Email already registered <a href="login.php">Login</a>';
    //         }
    //     }
    // }

    // if (isset($_SESSION['alert'])) {
    //     $alert = $_SESSION['alert'];
    //     $type = $_SESSION['type'];
    //     $alert_title = $_SESSION['alert_title'];
    //     $alert_message = $_SESSION['alert_message'];
    // }

    ?>

    <?php include '../../partials/flash_messages.php'; 
    $_SESSION['alert'] = false;
    $_SESSION['type'] = false;
    $_SESSION['alert_title'] = false;
    $_SESSION['alert_message'] = false;
    ?>


    <div class="container">
        <div class="card">
            <div class="card-header text-center ">
                <h3 class="fw-bold">Register</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <span class="w-50">
                        <label for="f_name" class="form-lable">First Name</label>
                        <input type="text" name="f_name" id="f_name" class="form-control mb-3" required>
                    </span>

                    <span class="w-50">
                        <label for="l_name" class="form-lable">Last Name</label>
                        <input type="text" name="l_name" id="l_name" class="form-control mb-3" required>
                    </span>

                    <span class="w-50">
                        <label for="email" class="form-lable">Email</label>
                        <input type="email" name="email" id="email" class="form-control mb-3" required>
                    </span>

                    <span class="w-50">
                        <label for="password" class="form-lable">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-3" required>
                    </span>

                    <span class="w-50">
                        <label for="cpassword" class="form-lable">Conform password</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control mb-3" required>
                    </span>

                    <div class="text-center">
                        <button name="register" class="btn btn-primary">Register</button>
                    </div>

                    <div class="text-center mt-3">Already have an account! <a href="./login.php">Login</a> </div>

                </form>


            </div>

        </div>
    </div>

</body>

</html>