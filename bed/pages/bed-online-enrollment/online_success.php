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
    <title>SFAC | Log in</title>
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


    <div class="content">
        <!-- /.login-logo -->
        <div class="card-header card-header-tabs border-bottom-0">
            <div class="card card-outline card-red shadow-lg">
                <div class="card-header text-center">
                    <a href="../../../index.php" class="h1"><img height="90" width="90"
                            src="../../../assets/img/logo.png" alt="logo-signin"></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Saint Francis of Assisi College Bacoor Campus</p>

                    <section class="content">
                    <div class="container-fluid pl-5 pr-5 pb-3">
                        <div class="card card-green shadow-lg">

                            <div class="card-header text-center">
                                <h3 class="text-lg" style="margin-bottom: unset;">
                                    FORM SUCCESSFULLY SUBMITTED
                                </h3>
                            </div>
                            <form action="../../../index.php" enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="row mb-4 mt-4 justify-content-center">
                                        <p>Your form has been successfully submitted and is now being processed. Please wait for further instruction regarding to your registration. <br> If at any point you have questions regarding to your application, please refer to contact information below. Thank you!</p>
                                    </div>
                                    <div class="form-group row mb-3 mt-3 justify-content-center">
                                        <div class="input-group col-md-8 mb-2">
                                          <div class="card bg-light d-flex flex-fill">
                                            <div class="card-header text-muted border-bottom-0">
                                              Contact Information
                                            </div>
                                            <div class="card-body pt-0">
                                              <div class="row">
                                                <div class="col-7">
                                                  <h2 class="lead"><b>Saint Francis of Assisi College - Bacoor Campus</b></h2>
                                                  <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> #96, Bayanan, City of Bacoor, Cavite</li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>  (046) 502 6289</li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-envelope"></i></span>  reg@gmail.com</li>
                                                    <li class="small"><span class="fa-li"><i class="fab fa-facebook-f"></i></span>  https://www.facebook.com/mysfacbacoor/</li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-globe"></i></span>  http://www.stfrancis.edu.ph/</li>
                                                  </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                  <img src="../../../assets/img/logo.png" alt="user-avatar" class="img-circle img-fluid">
                                                </div>
                                                <br>
                                                <br>
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                                    </div>
                                   

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn bg-green"><i
                                            class="fas fa-home"></i>
                                        Home</button>
                                </div>
                            </form>

                            <!-- /.card -->

                        </div><!-- /.container-fluid -->
                    </div>
                </section>

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