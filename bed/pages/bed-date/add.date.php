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
    <title>Add Academic Year | SFAC Bacoor</title>
    <?php include '../../includes/bed-head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link disabled text-light">Add Academic Year</a>
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
                <section class="content">
                    <div class="container-fluid pl-5 pr-5 pb-3">
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-8">
                                <div class="card card-info shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title">Effective Academic Year for Strands
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <!-- form start -->
                                    <form action="controlDate/ctrl.addDate.php" method="POST">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="input-group col-md-7 mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-sm"><b>Effective A.Y.
                                                            </b></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="yyyy-yyyy" data-mask
                                                        placeholder="Enter Effective Academic Year" name="eay" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn btn-info"><i
                                                    class="fas fa-calendar-plus m-1"> </i> Add Effective A.Y</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-info shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title">Academic School Year</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <!-- form start -->
                                    <form enctype="multipart/form-data" action="controlDate/ctrl.addDate.php"
                                        method="POST">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="input-group col-md-7 mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-sm"><b>Academic Year
                                                            </b></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="yyyy-yyyy" data-mask
                                                        placeholder="Enter Academic Year" name="acadyear" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" name="submit1" class="btn btn-info"><i
                                                    class="fas fa-calendar-plus m-1"> </i> Add Academic S.Y.</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->

                    </div><!-- /.container-fluid -->

                </section>
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->


            <!-- Footer and script -->
            <?php include '../../includes/bed-footer.php'; ?>
            <?php
            if (isset($_SESSION['year-exists'])) {
                echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('.swalDefaultError')
                Toast.fire({
                    icon: 'error',
                    title: 'Effective.A.Y Already Exist!'
                });
            });
            </script>";
            } elseif (isset($_SESSION['acyear-exists'])) {
                echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('.swalDefaultError')
                Toast.fire({
                    icon: 'error',
                    title: 'Academic Year Already Exists!'
                });
            });
            </script>";
            }
            unset($_SESSION['year-exists']);
            unset($_SESSION['acyear-exists']);
            ?>



</body>

</html>