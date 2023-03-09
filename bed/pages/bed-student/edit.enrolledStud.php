<?php
require '../../includes/conn.php';
session_start();
ob_start();


require '../../includes/bed-session.php';

$stud_id = $_GET['stud_id'];
$_SESSION['student_id'] = $stud_id;

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Enrollment | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Edit Student Details</a>
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
                                <h3 class="card-title">Update Student Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php $get_enrolled_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_lname, ', ', stud.student_fname,' ', stud.student_mname) AS fullname
                            FROM tbl_schoolyears AS sy
                            LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                            LEFT JOIN tbl_strands AS stds ON stds.strand_id = sy.strand_id
                            LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                            LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id =sy.grade_level_id
                            LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id  
                            WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND (sem.semester = '$_SESSION[active_semester]' OR sy.semester_id = '0')") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($get_enrolled_stud)) {
                            ?>
                            <form action="userData/ctrl.editEnrolledStud.php" enctype="multipart/form-data"
                                method="POST">
                                <div class="card-body">

                                    <input type="text" name="stud_id" value="<?php echo $row['student_id']; ?>" hidden>

                                    <input type="text" name="acadyear" value="<?php echo $row['ay_id']; ?>" hidden>
                                    <?php $get_sem = mysqli_query($conn, "SELECT * FROM tbl_active_semesters");
                                        while ($row2 = mysqli_fetch_array($get_sem)) { ?>
                                    <input type="text" name="sem" value="<?php echo $row2['semester_id']; ?>" hidden>
                                    <?php } ?>
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


                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-5 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Grade Level</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-placeholder="Select Grade Level"
                                                data-dropdown-css-class="select2-purple" name="grade_level" required>
                                                <option value="" disabled></option>
                                                <option value="<?php echo $row['grade_level_id']; ?>">
                                                    <?php echo $row['grade_level']; ?></option>
                                                <?php $get_grdlvl = mysqli_query($conn, "SELECT * FROM tbl_grade_levels WHERE grade_level_id NOT IN ('$row[grade_level_id]')");
                                                    while ($row2 = mysqli_fetch_array($get_grdlvl)) {
                                                    ?>
                                                <option value="<?php echo $row2['grade_level_id']; ?>">
                                                    <?php echo $row2['grade_level'];
                                                    } ?>
                                                </option>


                                            </select>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Student type</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-placeholder="Select Type" data-dropdown-css-class="select2-purple"
                                                name="stud_type" required>
                                                <option value="" disabled></option>
                                                <?php if ($row['stud_type'] == 'Transferee') {
                                                        echo '<option value="' . $row['stud_type'] . '">'
                                                            . $row['stud_type'] . '</option>';
                                                    } else {
                                                        echo ' <option value="' . $row['stud_type'] . '">'
                                                            . $row['stud_type'] . ' Student</option>';
                                                    } ?>

                                                <?php if ($row['stud_type'] == 'New') {
                                                        echo '<option value="Old">Old Student</option>
                                                        <option value="Transferee">Transferee</option>';
                                                    } else if ($row['stud_type'] == 'Old') {
                                                        echo ' <option value="New">New Student</option>
                                                        <option value="Transferee">Transferee</option>';
                                                    } else if ($row['stud_type'] == 'Transferee') {
                                                        echo ' <option value="New">New Student</option>
                                                        <option value="Old">Old Student</option>';
                                                    } ?>

                                            </select>
                                        </div>

                                    </div>


                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-6 mb-2 ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Strand</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-placeholder="Select Strand (for Senior High Student)"
                                                data-dropdown-css-class="select2-purple" name="strand">
                                                <option value="" disabled></option>
                                                <option value="<?php echo $row['strand_id']; ?>">
                                                    <?php echo $row['strand_def']; ?></option>
                                                <?php $get_strand = mysqli_query($conn, "SELECT * FROM tbl_strands WHERE strand_id NOT IN ('$row[strand_id]')");
                                                    while ($row3 = mysqli_fetch_array($get_strand)) {
                                                    ?> <option value="<?php echo $row3['strand_id']; ?>">
                                                    <?php echo $row3['strand_def'];
                                                    } ?></option>

                                            </select>
                                        </div>

                                        <div class="input-group col-md-4 mb-2 ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Section</b></span>
                                            </div> <input type="text" class="form-control" name="section"
                                                placeholder="Section of a Student"
                                                value="<?php echo $row['section']; ?>">
                                        </div>

                                    </div>




                                    <?php
                                } ?>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" name="submit" class="btn bg-purple"><i
                                                    class="fa fa-check text-sm"></i>
                                                Update Details</button>
                                        </div>
                                        <div class="justify-content-end mr-2">
                                            <?php if ($_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar") { ?>
                                            <a href="list.enrolledStud.php?search=<?php echo $_SESSION['search']; ?>&look="
                                                class="btn bg-gray btn-default">
                                                <?php  } else { ?>
                                                <a href="list.enrolledStud.php" class="btn bg-gray btn-default">

                                                    <?php } ?>

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