<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';

$get_active_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters AS asem
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = asem.semester_id");
while ($row = mysqli_fetch_array($get_active_sem)) {
    $sem = $row['semester_id'];
    $sem_n = $row['semester'];
}

$get_active_acad = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears AS aay
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = aay.ay_id");
while ($row = mysqli_fetch_array($get_active_acad)) {
    $acad = $row['ay_id'];
    $acad_n = $row['academic_year'];
}
?>



<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Dashboard | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Dashboard</a>
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
                <?php if ($_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Admission" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser" || $_SESSION['role'] == "Principal") {
                    include 'db.general.php';
                } else if ($_SESSION['role'] == "Student") {

                    $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
                    WHERE student_id = '$stud_id' AND semester_id = '0' AND ay_id = '$acad'") or die(mysqli_error($conn));
                    $result = mysqli_num_rows($get_level_id);

                    if ($result > 0) {
                        while ($row = mysqli_fetch_array($get_level_id)) {
                            $grade_level = $row['grade_level_id'];
                        }
                    } else {

                        $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
                    WHERE student_id = '$stud_id' AND semester_id = '$sem' AND ay_id = '$acad'") or die(mysqli_error($conn));
                        $result2 = mysqli_num_rows($get_level_id);

                        if ($result2 > 0) {
                            while ($row = mysqli_fetch_array($get_level_id)) {
                                $grade_level = $row['grade_level_id'];
                            }
                        }
                    }

                    if (!empty($grade_level)) {
                        if ($grade_level > 13) {
                            include 'db.studentSH.php';
                        } else if ($grade_level < 14) {
                            include 'db.student.php';
                        }
                    } else {
                        include 'db.studentSH.php';
                    }
                } else {
                    header('location: ../bed-500/page500.php');
                }
                ?>



            </div>
            <!-- /.content-wrapper -->


            <!-- Footer and script -->
            <?php include '../../includes/bed-footer.php';  ?>


</body>

</html>