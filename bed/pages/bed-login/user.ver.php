<?php
require '../../includes/conn.php';
session_start();
ob_start();

$confirm_mk = $_SESSION['email_mk'];
if ($confirm_mk == false) {
    header('location: forgot.pwd.php');
}
$confirm_reg = $_SESSION['email_reg'];
if ($confirm_reg == false) {
    header('location: forgot.pwd.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Accounts Verification | SFAC Bacoor</title>
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

    <!-- Custom css -->
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
        margin-top: 3%;
    }
    </style>
</head>

<body class="hold-transition login-page background"
    style="background-image: url('../../../assets/img/background/bgn-2.jpg')" ;>
</body>
<div class="login-box">
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <p class="h3"> <b>Identify Your Account</b></p>
        </div>
        <div class="card-body">
            <p class="login-box-msg">These accounts matched to your email.</p>
            <form action="controllerLogin/ctrl.forgot.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-danger btn-block">Request new
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

<!--modal toastr -->
<?php
if (isset($_SESSION['error'])) {
    echo "<script>
            $(function () {
                toastr.error('Something went wrong.')
            });
        </script>";
} elseif (isset($_SESSION['error_email'])) {
    echo "<script>
            $(function () {
                toastr.error('The email address you entered does not exist.')
            });
        </script>";
}
session_destroy();
?>
</script>

</body>

</html>