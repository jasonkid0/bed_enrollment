<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';
?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Error Page | SFAC Bacoor</title>
    <?php include '../../includes/bed-head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php
        if (isset($_SESSION['pre-loader'])) {
            echo ' <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../../assets/img/logo.png" alt="logo-preloader" height="100" width="100">
    </div>';
        }
        unset($_SESSION['pre-loader']); ?>


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link disabled text-light">Page 500</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link disabled text-light">Basic Education</a>
                </li>
            </ul>
            <?php include '../../includes/bed-navbar.php'; ?>

            <!-- sidebar menu -->
            <?php include '../../includes/bed-sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper pt-4">

                <!-- Main content -->

                <section class="content-header row">
                    <div class="error-page">
                        <h2 class="headline text-danger">500</h2>

                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

                            <p>
                                We will work on fixing that right away.
                                Meanwhile, you may <a href="../bed-dashboard/index.php">return to dashboard</a> or other
                                navigation.
                            </p>
                        </div>
                        <div class="mr-auto ml-auto mb-5">
                            <center><img src="cons.gif" class=" img img-bordered" alt="gif cartoon"
                                    style="width: 500px;"></center>
                        </div>
                    </div>
                    <!-- /.error-page -->

                </section>

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <!-- Footer and script -->
            <?php include '../../includes/bed-footer.php';  ?>


</body>

</html>