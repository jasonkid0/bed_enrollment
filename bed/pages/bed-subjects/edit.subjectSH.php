<?php
require '../../includes/conn.php';
session_start();
ob_start();



require '../../includes/bed-session.php';

$sub_id = $_GET['sub_id'];
$_SESSION['get_subID'] = $sub_id;

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Update Subjects | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Edit Subject</a>
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
                                <h3 class="card-title">Update Subjects for Senior High School Deparment</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php
                            $get_subInfo = mysqli_query($conn, "SELECT * FROM tbl_subjects_senior 
                            LEFT JOIN tbl_grade_levels ON tbl_grade_levels.grade_level_id = tbl_subjects_senior.grade_level_id
                            LEFT JOIN tbl_semesters ON tbl_semesters.semester_id = tbl_subjects_senior.semester_id
                            LEFT JOIN tbl_strands ON tbl_strands.strand_id = tbl_subjects_senior.strand_id
                            LEFT JOIN tbl_efacadyears ON tbl_efacadyears.efacadyear_id = tbl_subjects_senior.efacadyear_id
                            WHERE subject_id = '$sub_id'");

                            while ($row = mysqli_fetch_array($get_subInfo)) {
                                $strand_n = $row['strand_name'];
                                $eay = $row['efacadyear']; ?>
                            <form action="userData/ctrl.editSubSH.php<?php echo '?sub_id=' . $sub_id; ?>"
                                enctype="multipart/form-data" method="POST">
                                <div class="card-body">

                                    <div class="row mb-4 mt-4 justify-content-center">
                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Code</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="subject_code"
                                                placeholder="Enter Subject Code"
                                                value="<?php echo $row['subject_code']; ?>" required>
                                        </div>


                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Description</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="subject_description"
                                                placeholder="Enter Subject Description"
                                                value="<?php echo $row['subject_description']; ?>" required>
                                        </div>

                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Lecture Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="lec_units"
                                                placeholder="Enter No. of Unit(s)"
                                                value="<?php echo $row['lec_units']; ?>" required>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Laboratory Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="lab_units"
                                                placeholder="Enter No. of Unit(s)"
                                                value="<?php echo $row['lab_units']; ?>" required>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Total Unit(s)</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="total_units"
                                                placeholder="Enter Total Unit(s)"
                                                value="<?php echo $row['total_units']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mb-4 justify-content-center">

                                        <div class="input-group col-md-7 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Pre-Requisites</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="prerequisites"
                                                placeholder="Enter Pre-Requisites"
                                                value="<?php echo $row['pre_requisites']; ?>">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>E.A.Y</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Academic Year" name="eay" required>
                                                <option value="" disabled>Select Academic Year</option>
                                                <option value="<?php echo $row['efacadyear_id']; ?>">
                                                    <?php echo $row['efacadyear']; ?></option>
                                                <?php $result = mysqli_query($conn, "SELECT * FROM tbl_efacadyears WHERE efacadyear_id NOT IN (" . $row['efacadyear_id'] . ") ");
                                                    while ($row2 = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row2['efacadyear_id']; ?>">
                                                    <?php echo $row2['efacadyear'];
                                                    } ?></option>
                                            </select>
                                            <?php  ?>
                                        </div>


                                    </div>



                                    <div class="row mb-4 mt-4 justify-content-center">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Semester</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-dropdown-css-class="select2-purple" data-placeholder="Semester"
                                                name="semester" required>
                                                <option value="" disabled>Select Semester</option>
                                                <option value="<?php echo $row['semester_id']; ?>">
                                                    <?php echo $row['semester']; ?></option>
                                                <?php $result = mysqli_query($conn, "SELECT * FROM tbl_semesters WHERE semester_id NOT IN (" . $row['semester_id'] . ") ");
                                                    while ($row2 = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row2['semester_id']; ?>">
                                                    <?php echo $row2['semester'];
                                                    } ?></option>
                                            </select>
                                            <?php  ?>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Grade Level</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-dropdown-css-class="select2-purple" name="grade_level"
                                                data-placeholder="Select Grade Level">
                                                <option value="" disabled>Select Grade Level</option>
                                                <option value="<?php echo $row['grade_level_id']; ?>">
                                                    <?php echo $row['grade_level']; ?></option>
                                                <?php $result = mysqli_query($conn, "SELECT * FROM tbl_grade_levels WHERE grade_level_id NOT IN (" . $row['grade_level_id'] . ") LIMIT 13, 2");
                                                    while ($row2 = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row2['grade_level_id'] ?>">
                                                    <?php echo $row2['grade_level'];
                                                    } ?></option>
                                            </select>
                                        </div>
                                        <div class=" input-group col-md-3 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>Strand</b></span>
                                            </div>
                                            <select class="form-control select2 select2-purple custom-select"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Strand" name="strand_name">
                                                <option value="" disabled>Select Strand</option>
                                                <option value="<?php echo $row['strand_id'] ?>">
                                                    <?php echo $row['strand_name'] ?></option>
                                                <?php $result = mysqli_query($conn, "SELECT * FROM tbl_strands WHERE strand_id NOT IN (" . $row['strand_id'] . ")");
                                                    while ($row2 = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row2['strand_id']; ?>">
                                                    <?php echo $row2['strand_name'];
                                                    } ?></option>



                                            </select>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" name="submit" class="btn bg-purple"><i
                                                    class="fa fa-check"></i> Update</button>
                                        </div>
                                        <div class="justify-content-end mr-2">
                                            <?php if ($strand_n == "ABM") {
                                                    echo '<a href=" list.subjectSH.php?abm=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "STEM") {
                                                    echo '<a href=" list.subjectSH.php?stem=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "GAS") {
                                                    echo '<a href=" list.subjectSH.php?gas=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "HUMSS") {
                                                    echo '<a href=" list.subjectSH.php?humss=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } elseif ($strand_n == "TVL - HE") {
                                                    echo '<a href=" list.subjectSH.php?tvl=' . $strand_n . '&eay=' . $eay . '" class="btn bg-gray">';
                                                } ?><i class="fa fa-arrow-circle-left"></i>
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
            <?php include '../../includes/bed-footer.php';

            // alert 
            if (isset($_SESSION['success-sub'])) {
                echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Updated.'
})
}); 
</script>";
            }
            unset($_SESSION['success-sub']);
            ?>

</body>

</html>