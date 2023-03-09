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
    <title>Set Active Academic Year | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Set Active Academic Year & Semester</a>
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

                <section class="content">
                    <div class="container-fluid pl-5 pr-5 pb-3">
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-8">
                                <div class="card card-purple shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title">Set Active Academic Year
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <!-- form start -->

                                    <form action="controlDate/ctrl.setDate.php" method="POST">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="input-group col-md-7 mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-sm"><b>Active A.Y.
                                                            </b></span>
                                                    </div>
                                                    <select class="form-control select2 select2-purple custom-select"
                                                        name="act_acadyear"
                                                        data-placeholder="Select Active Academic Year"
                                                        data-dropdown-css-class="select2-purple" name="act_acadyear">
                                                        <option value="" disabled></option>
                                                        <?php $get_actacad = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears LEFT JOIN tbl_acadyears ON tbl_acadyears.ay_id = tbl_active_acadyears.ay_id") or die(mysqli_error($conn));
                                                        while ($row = mysqli_fetch_array($get_actacad)) {
                                                        ?>
                                                        <option value="<?php echo $row['ay_id']; ?>">Academic Year
                                                            <?php echo $row['academic_year']; ?></option>
                                                        <?php $get_acad = mysqli_query($conn, "SELECT * FROM tbl_acadyears WHERE  ay_id NOT IN (" . $row['ay_id'] . ")") or die(mysqli_error($conn));
                                                            while ($row2 = mysqli_fetch_array($get_acad)) {
                                                            ?>
                                                        <option value="<?php echo $row2['ay_id']; ?>">Academic Year
                                                            <?php echo $row2['academic_year'];
                                                            }
                                                        } ?></option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn bg-purple"><i
                                                    class="fas fa-calendar-check m-1"> </i> Set Academic Year</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-purple shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title">Academic School Year</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <!-- form start -->
                                    <form enctype="multipart/form-data" action="controlDate/ctrl.setDate.php"
                                        method="POST">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="input-group col-md-7 mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-sm"><b>Semester
                                                            </b></span>
                                                    </div>
                                                    <select class="form control select2 select2-purple custom-select"
                                                        data-placeholder="Select Semester"
                                                        data-dropdown-css-class="select2-purple" name="act_sem">
                                                        <option value="" disabled></option>
                                                        <?php $sltd_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters LEFT JOIN tbl_semesters ON tbl_semesters.semester_id = tbl_active_semesters.semester_id") or die(mysqli_error($conn));
                                                        while ($row1 = mysqli_fetch_array($sltd_sem)) {
                                                        ?>
                                                        <option value="<?php echo $row1['semester_id'];  ?>">
                                                            <?php echo $row1['semester'];
                                                                ?></option>
                                                        <?php $get_sem = mysqli_query($conn, "SELECT * FROM tbl_semesters WHERE semester_id NOT IN (" . $row1['semester_id'] . ")") or die(mysqli_error($conn));
                                                            while ($row = mysqli_fetch_array($get_sem)) {
                                                            ?>
                                                        <option value="<?php echo $row['semester_id']; ?>">
                                                            <?php echo $row['semester'];
                                                            }
                                                        } ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" name="submit1" class="btn bg-purple"><i
                                                    class="fas fa-calendar-check m-1"> </i> Set Semester</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </section>
                <!-- Main content -->


            </div><!-- /.container-fluid -->

            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Footer and script -->
    <?php include '../../includes/bed-footer.php'; ?>




</body>

</html>