<?php
require '../../includes/conn.php';
ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | SFAC Bacoor</title>
    <link rel="icon" href="../../../assets/img/logo.png" type="image/gif" sizes="16x16">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="../../plugins/toastr/toastr.min.js"></script>


    <!-- Custom css -->
    <style>
    .background {
        background-repeat: no-repeat;
        background-size: cover;
        background-position-x: right;
        background-position: bottom;

    }

    body {
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }

    .toast-top-right {
        right: unset;
        margin-top: 1%;
    }
    </style>
</head>

<body class="hold-transition login-page background"
    style="background-image: url('../../../assets/img/background/bg-4.jpg');">

    <!-- Preloader -->
    <?php
    if (isset($_POST['pre-loader'])) {
        echo ' <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../../assets/img/logo.png" alt="logo-preloader" height="100" width="100">
    </div>';
    } ?>


    <div class=" login-box">
        <!-- /.login-logo -->
        <div class="card-header card-header-tabs border-bottom-0">
            <div class="card card-outline card-red shadow-lg">
                <div class="card-header text-center">
                    <a href="../../../index.php" class="h1"><img height="90" width="90"
                            src="../../../assets/img/logo.png" alt="logo-signin"></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Saint Francis of Assisi College Bacoor Campus</p>

                    <form action="controllerLogin/ctrl.login.php" method="POST">
                        <div class="input-group mb-3 form-control-border">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text input-da">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-8">
                                <p class="text-sm">
                                    <a class="text-lightblue" href="forgot.pwd.php">I forgot my
                                        password</a>
                                </p>
                                <!-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> -->
                            </div>

                            <!-- /.col -->
                            <div class="col-4 mb-2">
                                <button type="submit" class="btn bg-red btn-default btn-block p-2" name="submit">Sign
                                    in</button>

                            </div>
                            <!-- /.col -->
                        </div>


                    </form>

                    <!-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                    <!-- /.social-auth-links -->


                    <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- Validation toast -->
    <?php
    if (isset($_SESSION['pwd-error'])) {
        echo "<script>
    $(function() {
        toastr.error('The password you’ve entered is incorrect.')
    });
    </script>";
    } elseif (isset($_SESSION['no-input'])) {
        echo "<script>
            $(function () {
                toastr.error('Enter your valid username and password.')
            });
        </script>";
    }
    session_destroy();
    ?>
    <!-- End Validation toast -->


</body>

</html>