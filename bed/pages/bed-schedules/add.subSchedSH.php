<?php
require '../../includes/conn.php';
session_start();
ob_start();


require '../../includes/bed-session.php';
$sub_id = $_GET['sub_id'];


$get_subID = mysqli_query($conn, "SELECT * FROM tbl_subjects_senior WHERE subject_id = '$sub_id'");
$result = mysqli_num_rows($get_subID);
if ($result > 0) {
    $_SESSION['sub_id'] = $sub_id;
} else {
    header('location: ../bed-404/page404.php');
}



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
                                <h3 class="card-title">Set Schedules for Senior High</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php $get_subject = mysqli_query($conn, "SELECT * FROM tbl_subjects_senior AS sub
                            LEFT JOIN tbl_strands AS strd ON strd.strand_id = sub.strand_id 
                            LEFT JOIN tbl_efacadyears AS eay on eay.efacadyear_id = sub.efacadyear_id
                            WHERE sub.subject_id = '$sub_id'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($get_subject)) {
                                $strand_n = $row['strand_name'];
                                $eay = $row['efacadyear'];
                            ?>

                            <form action="subjectsData/ctrl.addsubSchedSH.php" enctype="multipart/form-data"
                                method="POST">
                                <div class="card-body">

                                    <?php $acadyear = $_SESSION['active_acadyears'];
                                        $sem = $_SESSION['active_semester'];
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
                                        <?php if ($strand_n == "ABM") {
                                            } ?>
                                        <div class="justify-content-end mr-2">
                                            <?php if ($strand_n == "ABM") {
                                                    echo '<a href=" ../bed-subjects/list.offerSubSH.php?abm=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "STEM") {
                                                    echo '<a href=" ../bed-subjects/list.offerSubSH.php?stem=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "GAS") {
                                                    echo '<a href=" ../bed-subjects/list.offerSubSH.php?gas=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "HUMSS") {
                                                    echo '<a href=" ../bed-subjects/list.offerSubSH.php?humss=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "TVL - HE") {
                                                    echo '<a href=" ../bed-subjects/list.offerSubSH.php?tvl=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
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