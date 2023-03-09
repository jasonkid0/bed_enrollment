<?php
require '../../includes/conn.php';
session_start();
ob_start();


require '../../includes/bed-session.php';

$get_active_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters");
while ($row = mysqli_fetch_array($get_active_sem)) {
    $sem = $row['semester_id'];
}

$get_active_acad = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears");
while ($row = mysqli_fetch_array($get_active_acad)) {
    $acad = $row['ay_id'];
}

$get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
WHERE student_id = '$stud_id' AND semester_id = '0' AND ay_id = '$acad'") or die(mysqli_error($conn));
$result = mysqli_num_rows($get_level_id);

if ($result > 0) {
    header('location: ../bed-subjects/list.enrolledSubPJH.php');
} else {

    $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
WHERE student_id = '$stud_id' AND semester_id = '$sem' AND ay_id = '$acad'") or die(mysqli_error($conn));
    $result2 = mysqli_num_rows($get_level_id);

    if ($result2 > 0) {
        header('location: ../bed-subjects/list.enrolledSubSH.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Enroll Now | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Enroll Now</a>
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
                        <div class="card card-lightblue shadow-lg">
                            <div class="card-header">
                                <h3 class="card-title">Enrollment Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php $get_stud = mysqli_query($conn, "SELECT *, CONCAT(tbl_students.student_lname, ', ', tbl_students.student_fname,' ', tbl_students.student_mname) AS fullname FROM tbl_students WHERE student_id = '$stud_id'");
                            while ($row = mysqli_fetch_array($get_stud)) {
                            ?>
                            <form action="userData/ctrl.addEnroll.php" enctype="multipart/form-data" method="POST">
                                <div class="card-body">

                                    <input type="text" name="stud_id" value="<?php echo $row['student_id']; ?>" hidden>

                                    <?php $get_act_acad = mysqli_query($conn, "SELECT * FROM tbl_active_acadyears");
                                        while ($row2 = mysqli_fetch_array($get_act_acad)) {
                                            echo '<input type="text" name="acadyear" value="' . $row2['ay_id'] . '" hidden>';
                                        }
                                        ?>

                                    <?php $get_act_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters");
                                        while ($row2 = mysqli_fetch_array($get_act_sem)) {
                                            echo '<input type="text" name="sem" value="' . $row2['semester_id'] . '" hidden>';
                                        }
                                        ?>

                                    <input type="text" name="remark" value="Pending" hidden>

                                    <div class="row mb-4 mt-4 justify-content-center">
                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Student ID</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="studno"
                                                placeholder="Student ID" value="<?php echo $row['stud_no'] ?>" readonly>
                                        </div>


                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Name</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="<?php echo $row['fullname'] ?>" readonly>
                                        </div>

                                    </div>
                                    <?php } ?>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-5 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Grade Level</b></span>
                                            </div>
                                            <select class="form-control select2 select2-lightblue custom-select"
                                                data-placeholder="Select Grade Level"
                                                data-dropdown-css-class="select2-lightblue" name="grade_level" required>
                                                <option value="" selected disabled></option>
                                                <?php $get_grdlvl = mysqli_query($conn, "SELECT * FROM tbl_grade_levels");
                                                while ($row = mysqli_fetch_array($get_grdlvl)) {
                                                ?>
                                                <option value="<?php echo $row['grade_level_id']; ?>">
                                                    <?php echo $row['grade_level'];
                                                } ?>
                                                </option>


                                            </select>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Student type</b></span>
                                            </div>
                                            <select class="form-control select2 select2-lightblue custom-select"
                                                data-placeholder="Select Type"
                                                data-dropdown-css-class="select2-lightblue" name="stud_type" required>
                                                <option value="" selected disabled></option>
                                                <option value="New">New Student</option>
                                                <option value="Old">Old Student</option>
                                                <option value="Transferee">Transferee</option>

                                            </select>
                                        </div>

                                    </div>


                                    <div class="row mb-4 justify-content-center">



                                        <div class="input-group col-md-6 mb-2 ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Strand</b></span>
                                            </div>
                                            <select class="form-control select2 select2-lightblue custom-select"
                                                data-placeholder="Select Strand (for Senior High Student)"
                                                data-dropdown-css-class="select2-lightblue" name="strand">
                                                <option value="" selected disabled></option>
                                                <?php $get_strand = mysqli_query($conn, "SELECT * FROM tbl_strands");
                                                while ($row = mysqli_fetch_array($get_strand)) {
                                                ?> <option value="<?php echo $row['strand_id']; ?>">
                                                    <?php echo $row['strand_def'];
                                                } ?></option>

                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn bg-lightblue"><i
                                            class="fa fa-check text-sm"></i>
                                        Enroll Now</button>
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
            <?php if (isset($_SESSION['dbl-stud'])) {
                echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'This Student has already submitted.'
    });
});
</script>";
            } elseif (isset($_SESSION['double-lrn'])) {
                echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'LRN already exists.'
    });
});
</script>";
            } elseif (isset($_SESSION['field_required'])) {
                echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'All fields are required!'
    });
});
</script>";
            }
            unset($_SESSION['field_required']);
            unset($_SESSION['double-lrn']);
            unset($_SESSION['dbl-stud']); ?>


</body>

</html>