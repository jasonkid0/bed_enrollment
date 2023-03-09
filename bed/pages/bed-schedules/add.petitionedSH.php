<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';
$eay = $_GET['eay'];
$_SESSION['eay'] = $eay;
$strand_name = $_GET['str'];
$_SESSION['strand_n'] = $strand_name;
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
                                <h3 class="card-title">Add Petitioned Subjects for Senior High
                                    <?php if ($strand_name == 'STEM') {
                                        echo '(STEM)';
                                    } elseif ($strand_name == 'ABM') {
                                        echo ' (ABM)';
                                    } elseif ($strand_name == 'GAS') {
                                        echo ' (GAS)';
                                    } elseif ($strand_name == 'HUMSS') {
                                        echo ' (HUMSS)';
                                    } elseif ($strand_name == 'TVL - HE') {
                                        echo ' (TVL-HE)';
                                    } else {
                                        header('location: ../bed-404/page404.php');
                                    } ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="subjectsData/ctrl.add.petitionedSH.php" enctype="multipart/form-data"
                                method="POST">
                                <div class="card-body">

                                    <?php $acadyear = $_SESSION['active_acadyears'];
                                    $sem = $_SESSION['active_semester'];
                                    ?>

                                    <input value="<?php echo $acadyear; ?>" hidden name="acadyear">
                                    <input value="<?php echo $sem; ?> " hidden name="sem">


                                    <div class="row mb-4 mt-4 justify-content-center">


                                        <div class="input-group col-md-8 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Code & Subject</b></span>
                                            </div>
                                            <select class="form-control select2 select2-info custom-select"
                                                data-placeholder="Select a Subject"
                                                data-dropdown-css-class="select2-info" name="sub" required>
                                                <option value="" selected disabled>Select Subject</option>

                                                <?php
                                                $active_sem = $_SESSION['active_semester'];
                                                $get_offersub = mysqli_query($conn, "SELECT * FROM tbl_subjects_senior AS subsen LEFT JOIN tbl_strands AS strd ON strd.strand_id = subsen.strand_id 
                                                LEFT JOIN tbl_semesters AS sem ON sem.semester_id = subsen.semester_id 
                                                LEFT JOIN tbl_efacadyears AS eay ON eay.efacadyear_id = subsen.efacadyear_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = subsen.grade_level_id
                                                WHERE sem.semester NOT IN ('$active_sem') AND strd.strand_name = '$strand_name' AND eay.efacadyear = '$eay'");
                                                while ($row = mysqli_fetch_array($get_offersub)) {

                                                ?>
                                                <option value="<?php echo $row['subject_id']; ?>">
                                                    <?php echo $row['subject_code'] . ' - ', ' ' . $row['subject_description'] . ' - (' . $row['semester'] . ') - (' . $row['grade_level'] . ')'; ?>
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
                                            <?php if ($strand_name == "ABM") {
                                                echo '<a href=" ../bed-subjects/list.offerSubSH.php?abm=' . $strand_name . '&eay=' . $eay . '" class="btn bg-gray">';
                                            } elseif ($strand_name == "STEM") {
                                                echo '<a href=" ../bed-subjects/list.offerSubSH.php?stem=' . $strand_name . '&eay=' . $eay . '" class="btn bg-gray">';
                                            } elseif ($strand_name == "GAS") {
                                                echo '<a href=" ../bed-subjects/list.offerSubSH.php?gas=' . $strand_name . '&eay=' . $eay . '" class="btn bg-gray">';
                                            } elseif ($strand_name == "HUMSS") {
                                                echo '<a href=" ../bed-subjects/list.offerSubSH.php?humss=' . $strand_name . '&eay=' . $eay . '" class="btn bg-gray">';
                                            } elseif ($strand_name == "TVL - HE") {
                                                echo '<a href=" ../bed-subjects/list.offerSubSH.php?tvl=' . $strand_name . '&eay=' . $eay . '" class="btn bg-gray">';
                                            } ?>
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