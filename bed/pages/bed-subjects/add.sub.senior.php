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
    <title>Add Subjects | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Add Subject</a>
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
                        <div class="card card-info shadow-lg">
                            <div class="card-header">
                                <h3 class="card-title">Add Subjects for Senior High School Deparment</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="userData/ctrl.add.sub.senior.php" enctype="multipart/form-data" method="POST">
                                <div class="card-body">

                                    <div class="row mb-4 mt-4 justify-content-center">
                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Code</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="subject_code"
                                                placeholder="Enter Subject Code" required>
                                        </div>


                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Description</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="subject_description"
                                                placeholder="Enter Subject Description" required>
                                        </div>

                                    </div>


                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Lecture Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="lec_units"
                                                placeholder="Enter No. of Unit(s)">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Laboratory Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="lab_units"
                                                placeholder="Enter No. of Unit(s)">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Total Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="total_units"
                                                placeholder="Enter Total Unit(s)">
                                        </div>
                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-7 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Pre-Requisites</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="prerequisites"
                                                placeholder="Enter Pre-Requisites">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>E.A.Y</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-dropdown-css-class="select2-info"
                                                data-placeholder="Effective Academic" name="eay" required>
                                                <option value="" disabled selected>Select Semester</option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tbl_efacadyears ");
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo '<option value="' . $row2['efacadyear_id'] . '">' . $row2['efacadyear'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-4 mt-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Semester</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-dropdown-css-class="select2-info"
                                                data-placeholder="Select Semester" name="semester" required>
                                                <option value="" disabled selected>Select Semester</option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * from tbl_semesters");
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo '<option value="' . $row2['semester_id'] . '">' . $row2['semester'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Grade Level</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-dropdown-css-class="select2-info"
                                                data-placeholder="Select Grade Level" name="grade_level" required>
                                                <option value="" disabled selected>Select Grade Level</option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * from tbl_grade_levels LIMIT 13, 2");
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo '<option value="' . $row2['grade_level_id'] . '">' . $row2['grade_level'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="input-group col-md-3 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Strand</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-dropdown-css-class="select2-info" data-placeholder="Select Strand"
                                                name="strand_name" required>
                                                <option value="" disabled selected>Select Strand</option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * from tbl_strands");
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo '<option value="' . $row2['strand_id'] . '">' . $row2['strand_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-plus"></i>
                                        Add Subject</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <!-- Footer and script -->
            <?php include '../../includes/bed-footer.php';  ?>



</body>

</html>