<?php include '../partials/db_connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 500px;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    $alert = false;

    // if (isset($_SESSION['email'])) {
    //     header('Location: ../index.php');
    // }

    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result =  $conn->query($sql);
        $data = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            if ($data['varification_status'] == "Yes") {

                $db_password = $data['password'];

                if ($db_password == $password) {

                    $_SESSION['f_name'] = $data['f_name'];
                    $_SESSION['l_name'] = $data['l_name'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['password'] = $data['password'];

                    $_SESSION['alert'] = true;
                    $_SESSION['type'] = 'success';
                    $_SESSION['alert_title'] = "Welocme" . " " . $data['f_name'] . " !";
                    $_SESSION['alert_message'] = 'You are successfully loged in';
                    header('Location: ../index.php');
                } else {

                    $_SESSION['alert'] = true;
                    $_SESSION['type'] = 'warning';
                    $_SESSION['alert_title'] = "Fail!";
                    $_SESSION['alert_message'] = "Your email or password is incorrect";
                }
            } else {
                $_SESSION['alert'] = true;
                $_SESSION['type'] = 'warning';
                $_SESSION['alert_title'] = "Fail!";
                $_SESSION['alert_message'] = "Your email is not verified. Please check your inbox";
            }
        } else {
            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'warning';
            $_SESSION['alert_title'] = "Fail!";
            $_SESSION['alert_message'] = "Your email or password is incorrect";
        }
    }

    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        $type = $_SESSION['type'];
        $alert_title = $_SESSION['alert_title'];
        $alert_message = $_SESSION['alert_message'];
    }
    ?>

    <?php include '../partials/flash_messages.php';

    $_SESSION['alert'] = false;
    ?>

    <div class="container">
        <div>
            <div class="text-end">
                <a href="../index.php" class="btn btn-outline-primary mb-2">Return back</a>
            </div>
            <div class="card" style="box-shadow: 0px 0px 6px 1px gray;">
                <div class="card-header text-center ">
                    <h3 class="fw-bold">Login</h3>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">

                        <span class="w-50">
                            <label for="email" class="form-lable">Email</label>
                            <input type="email" name="email" id="email" class="form-control mb-3" required>
                        </span>

                        <span class="w-50">
                            <label for="password" class="form-lable">Password</label>
                            <input type="password" name="password" id="password" class="form-control mb-3" required>
                        </span>

                        <div class="text-center">
                            <button name="login" class="btn btn-primary">Login</button>
                        </div>

                        <div class="text-center mt-3">Did not have an account! <a href="./register.php">Register</a> </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


</body>

</html>