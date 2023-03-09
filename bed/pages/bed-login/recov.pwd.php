<?php
require '../../includes/conn.php';
session_start();
ob_start();

$email = $_SESSION['email'];
$code = $_SESSION['code'];
if ($code == false) {
    header("location: forgot.pwd.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Recovery | SFAC Bacoor</title>
    <link rel="icon" href="../../../assets/img/logo.png" type="image/gif" sizes="16x16">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">


    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="../../plugins/toastr/toastr.min.js"></script>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .background {
        background-repeat: no-repeat;
        background-size: cover;
        background-position-x: right;
        background-position-y: bottom;

    }

    .toast-top-right {
        right: unset;
        margin-top: 1%;
    }
    </style>
</head>

<body class="hold-transition login-page background"
    style="background-image: url('../../../assets/img/background/bgn-2.jpg');">
    <div class="login-box">
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <p class="h3"> <b>Password Reset</b> </p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">A strong password helps prevent unauthorized access to your account.
                </p>
                <form action="controllerLogin/ctrl.recov.php" method="post">
                    <div class="input-group mb-3">
                        <?php if (isset($_POST['submit'])) {
                            $_SESSION['email'] = $email;
                            $_SESSION['code'] = $code;
                        } ?>
                        <!-- <input type="text" name="email" value="<?php //echo $email 
                                                                    ?>">
                        <input type="text" name="code" value="<?php //echo $code 
                                                                ?>"> -->
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password2" placeholder="Confirm Password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-danger btn-block">Change
                                password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1 text-sm">
                    <a class="text-lightblue" href="login.php">Back to Sign in</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->


    <!-- Modal toastr -->
    <?php
    if (isset($_SESSION['error-pass'])) {
        echo "<script>
        $(function () {
            toastr.error('Those passwords didn\'t match. Please try again.')
        });
    </script>";
    }
    unset($_SESSION['error-pass']);
    ?>


</body>

</html>