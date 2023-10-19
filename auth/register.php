<?php include '../partials/db_connect.php' ?>


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

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;



    function email_varification($name, $email, $varification_token)
    {
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
            $mail->addAddress($email, $name);     //Add a recipient
            $mail->addReplyTo('mail.2.malikali97@gmail.com', 'iPhone Store');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email verification from iPhone Store';
            $mail->Body    = "
            <h2>You have registered with iPhone Store</h2>
            <h5>Verify your email address to login with the below given link</h5>
            <br><br>
            <a href='http://localhost/Projects/shopping_cart/action.php?varification_token=$varification_token'>Verify email</a>
            ";
            // http://localhost/Projects/shopping_cart/action.php?varification_token=$varification_token'
            // http://alisportfolio.com/e-Commerce/action.php?varification_token=$varification_token'

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    $alert = false;

    if (isset($_POST['register'])) {

        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $varification_token = md5(rand());

        if ($password != $cpassword) {

            $_SESSION['alert'] = true;
            $_SESSION['type'] = 'warning';
            $_SESSION['alert_title'] = "Fail!";
            $_SESSION['alert_message'] = "Password do not match";
        } else {

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result =  $conn->query($sql);

            if ($result->num_rows == 0) {

                $sql = "INSERT INTO users(f_name, l_name, email, password, varification_token)
                        VALUES('$f_name', '$l_name', '$email', '$password', '$varification_token')";

                $conn->query($sql);

                $name = $f_name . " " . $l_name;

                email_varification("$name", "$email", "$varification_token");

                $_SESSION['alert'] = true;
                $_SESSION['type'] = 'success';
                $_SESSION['alert_title'] = "Successfully registered!";
                $_SESSION['alert_message'] = 'Check your inbox to varify email';

                // header('Location: login.php');
            } else {

                $_SESSION['alert'] = true;
                $_SESSION['type'] = 'warning';
                $_SESSION['alert_title'] = "Fail!";
                $_SESSION['alert_message'] = 'Email already registered <a href="./login.php">Login</a>';
            }
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
        <div class="card" style="box-shadow: 0px 0px 6px 1px gray;">
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