<?php
require '../../includes/conn.php';
session_start();
ob_start();


require '../../includes/bed-session.php';
$sub_id = $_GET['sub_id'];
$sched_id = $_GET['sched_id'];


$get_subID = mysqli_query($conn, "SELECT * FROM tbl_schedules WHERE subject_id = '$sub_id' AND schedule_id = '$sched_id'");
$result = mysqli_num_rows($get_subID);
if ($result > 0) {
    $_SESSION['sub_id'] = $sub_id;
    $_SESSION['sched_id'] = $sched_id;
} else {
    header('location: ../bed-404/page404.php');
}



?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Class Schedule | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Edit Schedule</a>
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
                        <div class="card card-purple shadow-lg">
                            <div class="card-header">
                                <h3 class="card-title">Edit Class Schedule for Grade School</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <?php
                            $act_acad = $_SESSION['active_acadyears'];
                            $get_subject = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teacher_lname) AS fullname FROM tbl_schedules AS sched
                             LEFT JOIN tbl_subjects AS sub ON sub.subject_id = sched.subject_id
                             LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                             LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                            WHERE sched.subject_id = '$sub_id' AND sched.semester = 0 AND sched.schedule_id = '$_SESSION[sched_id]' AND acadyear = '$act_acad'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($get_subject)) {
                                $grd_lvl = $row['grade_level'];

                            ?>

                            <form action="subjectsData/ctrl.listSubSchedPJH.php" enctype="multipart/form-data"
                                method="POST">
                                <div class="card-body">

                                    <?php $acadyear = $_SESSION['active_acadyears'];
                                        $sem = 0
                                        ?>

                                    <input value="<?php echo $acadyear; ?>" hidden name="acadyear">
                                    <input value="<?php echo $sem; ?> " hidden name="sem">
                                    <input value="<?php echo $sub_id; ?> " hidden name="sub_id">

                                    <div class="row mb-4 mt-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Code</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="code"
                                                value="<?php echo $row['subject_code']; ?>" readonly>
                                        </div>


                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Description</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="subject" value="<?php echo $row['subject_description'];
                                                                                                                ?>"
                                                readonly>
                                        </div>

                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Days</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="days"
                                                value="<?php echo $row['day']; ?>" placeholder="M, T, W, TH, F, S"
                                                required>
                                        </div>



                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Time</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="time"
                                                value="<?php echo $row['time']; ?>" placeholder="hh:mm - hh:mm AM/PM"
                                                required>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Room</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="room"
                                                value="<?php echo $row['room']; ?>" placeholder="Enter a Room name"
                                                required>
                                        </div>

                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Instructor</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-placeholder="Select Instructor"
                                                data-dropdown-css-class="select2-purple" name="instruct">
                                                <option value="" disabled></option>
                                                <option value=" ">TBA</option>
                                                <option selected value="<?php echo $row['teacher_id']; ?>">
                                                    <?php echo $row['fullname'];
                                                        ?></option>
                                                <?php $get_teachers = mysqli_query($conn, "SELECT *, CONCAT(tbl_teachers.teacher_fname, ' ', LEFT(tbl_teachers.teacher_mname,1), '. ', tbl_teachers.teacher_lname) AS fullname FROM tbl_teachers WHERE teacher_id NOT IN ('$row[teacher_id]')") or die(mysqli_error($conn));
                                                    while ($row2 = mysqli_fetch_array($get_teachers)) {
                                                    ?>
                                                <option value="<?php echo $row2['teacher_id']; ?>">
                                                    <?php echo $row2['fullname'];
                                                    } ?></option>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" name="submit" class="btn bg-purple"><i
                                                    class="fa fa-check"></i>
                                                Submit</button>
                                        </div>

                                        <div class="justify-content-end mr-2">
                                            <?php if ($grd_lvl == "Grade 1") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g1=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 2") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g2=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 3") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g3=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 4") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g4=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 5") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g5=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 6") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g6=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 7") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g7=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 8") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g8=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 9") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g9=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Grade 10") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?g10=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Nursery") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?nurs=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Pre-Kinder") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?pkdr=' . $grd_lvl . '" class="btn bg-gray">';
                                                } elseif ($grd_lvl == "Kinder") {
                                                    echo '<a href=" ../bed-schedules/list.subSchedPJH.php?kdr=' . $grd_lvl . '" class="btn bg-gray">';
                                                } ?>
                                            <i class="fa fa-arrow-circle-left"></i>
                                            Back</a>
                                        </div>

                                    </div>
                                </div>
                                <?php } ?>
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