<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';
$grade_lvl = $_GET['g'];
$_SESSION['grade_lvl'] = $grade_lvl;
?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Offer/Open Subjects | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Set Schedules</a>
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
                                <h3 class="card-title">Add Petitioned Subjects for
                                    <?php if ($grade_lvl == 'Grade 1') {
                                        echo 'Grade 1';
                                    } elseif ($grade_lvl == 'Grade 2') {
                                        echo 'Grade 2';
                                    } elseif ($grade_lvl == 'Grade 3') {
                                        echo 'Grade 3';
                                    } elseif ($grade_lvl == 'Grade 4') {
                                        echo 'Grade 4';
                                    } elseif ($grade_lvl == 'Grade 5') {
                                        echo 'Grade 5';
                                    } elseif ($grade_lvl == 'Grade 6') {
                                        echo 'Grade 6';
                                    } elseif ($grade_lvl == 'Grade 7') {
                                        echo 'Grade 7';
                                    } elseif ($grade_lvl == 'Grade 8') {
                                        echo 'Grade 8';
                                    } elseif ($grade_lvl == 'Grade 9') {
                                        echo 'Grade 9';
                                    } elseif ($grade_lvl == 'Grade 10') {
                                        echo 'Grade 10';
                                    } elseif ($grade_lvl == 'Nursery') {
                                        echo 'Nursery';
                                    } elseif ($grade_lvl == 'Pre-Kinder') {
                                        echo 'Pre-Kinder';
                                    } elseif ($grade_lvl == 'Kinder') {
                                        echo 'Kinder';
                                    } else {
                                        header('location: ../bed-404/page404.php');
                                    } ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="subjectsData/ctrl.add.petitionedPJH.php" enctype="multipart/form-data"
                                method="POST">
                                <div class="card-body">

                                    <?php $acadyear = $_SESSION['active_acadyears'];
                                    $get_glvl_id = mysqli_query($conn, "SELECT * FROM tbl_grade_levels WHERE grade_level = '$grade_lvl'");
                                    while ($row = mysqli_fetch_array($get_glvl_id)) {
                                        $glevel_id = $row['grade_level_id'];
                                    }
                                    ?>
                                    <input value="<?php echo $glevel_id; ?>" hidden name="glvl">
                                    <input value="<?php echo $acadyear; ?>" hidden name="acadyear">

                                    <div class="row mb-4 mt-4 justify-content-center">


                                        <div class="input-group col-md-8 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Code & Subject &
                                                        Level</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-placeholder="Select a Subject"
                                                data-dropdown-css-class="select2-info" name="sub" required>
                                                <option value="" selected disabled>Select Subject</option>

                                                <?php
                                                $active_sem = $_SESSION['active_semester'];
                                                $get_offersub = mysqli_query($conn, "SELECT * FROM tbl_subjects AS sub
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                WHERE gl.grade_level NOT IN ('$grade_lvl')");
                                                while ($row = mysqli_fetch_array($get_offersub)) {

                                                ?>
                                                <option value="<?php echo $row['subject_id']; ?>">
                                                    <?php echo $row['subject_code'] . ' -- ' .  $row['subject_description'] . ' -- ' . $row['grade_level']; ?>
                                                </option>

                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-4 justify-content-center">


                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Days</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="days"
                                                placeholder="M, T, W, TH, F, S" required>
                                        </div>



                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Time</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="time"
                                                placeholder="hh:mm - hh:mm AM/PM" required>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Room</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="room"
                                                placeholder="Enter a Room name" required>
                                        </div>

                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Instructor</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-placeholder="Select Instructor"
                                                data-dropdown-css-class="select2-info" name="instruct">
                                                <option value="" selected disabled></option>
                                                <?php $get_teachers = mysqli_query($conn, "SELECT *, CONCAT(tbl_teachers.teacher_fname, ' ', LEFT(tbl_teachers.teacher_mname,1), '. ', tbl_teachers.teacher_lname) AS fullname FROM tbl_teachers") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($get_teachers)) {
                                                ?>
                                                <option value="<?php echo $row['teacher_id']; ?>">
                                                    <?php echo $row['fullname'];
                                                } ?></option>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" name="submit" class="btn bg-info"><i
                                                    class="fa fa-check"></i>
                                                Submit</button>
                                        </div>
                                        <div class="justify-content-end mr-2">
                                            <?php if ($grade_lvl == "Grade 1") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g1=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 2") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g2=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 3") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g3=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 4") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g4=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 5") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g5=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 6") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g6=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 7") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g7=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 8") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g8=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 9") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g9=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Grade 10") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?g10=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Nursery") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?nurs=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Pre-Kinder") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?pkdr=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            } elseif ($grade_lvl == "Kinder") {
                                                echo '<a href="../bed-subjects/list.offerSubPJH.php?kdr=' . $grade_lvl . '"
                                            class="btn bg-gray">';
                                            }  ?>
                                            <i class="fa fa-arrow-circle-left"></i>
                                            Back</a>
                                        </div>

                                    </div>
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
            <?php if (isset($_SESSION['dbl-sched'])) {
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
        title:  'Schedule already exists!'
    });
});
</script>";
            }
            unset($_SESSION['dbl-sched']); ?>


</body>

</html>