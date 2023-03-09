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
                    <?php if ($_SESSION['role'] == "Accounting") { ?>
                    <a href="#" class="nav-link disabled text-light">Confirmed Students</a>
                    <?php } else { ?>
                    <a href="#" class="nav-link disabled text-light">Pending Enrollees</a>
                    <?php } ?>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link disabled text-light">Basic Education</a>
                </li>
            </ul>
            <?php include '../../includes/bed-navbar.php'; ?>

            <!-- sidebar menu -->
            <?php include '../../includes/bed-sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper pt-4 pb-2">

                <!-- TABLES -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header bg-navy p-3">
                                        <?php if ($_SESSION['role'] == "Accounting") { ?>
                                        <h3 class="card-title text-lg">Confirmed Students</h3>
                                        <?php } else { ?>
                                        <h3 class="card-title text-lg">Pending Enrollees </h3>
                                        <?php } ?>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <?php if ($_SESSION['role'] == "Accounting") { ?>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 mb-3 mt-2">
                                                <form method="GET">
                                                    <div class="input-group">
                                                        <input type="search" class="form-control"
                                                            placeholder="Search for (Student no. or Name)"
                                                            name="search">
                                                        <div class="input-group-append">
                                                            <button type="submit" name="look" class="btn bg-navy"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Search">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <hr class="bg-navy">
                                        <?php } ?>

                                        <table id="example2" class="table table-hover">
                                            <thead class="bg-gray-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Student ID</th>
                                                    <th>Fullname</th>
                                                    <th>Strand</th>
                                                    <th>Grade Level</th>
                                                    <th>Student Type</th>
                                                    <th>Date Applied</th>
                                                    <th>Remark</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">

                                                <?php
                                                if ($_SESSION['role'] == "Accounting") {
                                                    if (isset($_GET['look'])) {

                                                        $_GET['search'] = addslashes($_GET['search']);
                                                        $_SESSION['search'] = $_GET['search'];

                                                        $get_enrolled_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_lname, ', ', stud.student_fname, ' ', stud.student_mname) AS fullname 
                                                    FROM tbl_schoolyears AS sy
                                                    LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                                                    LEFT JOIN tbl_strands AS stds ON stds.strand_id = sy.strand_id
                                                    LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                                                    LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id =sy.grade_level_id
                                                    LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id  
                                                    WHERE ay.academic_year = '$_SESSION[active_acadyears]' AND (sem.semester = '$_SESSION[active_semester]' OR sy.semester_id = '0') AND (remark = 'Confirmed' OR remark = 'Approved' OR remark = 'Disapproved')
                                                    AND (stud.student_lname LIKE '%$_GET[search]%'
                                                    OR stud.student_fname LIKE '%$_GET[search]%'
                                                    OR stud.student_mname LIKE '%$_GET[search]%'
                                                    OR stud.stud_no LIKE '%$_GET[search]%')
                                                    ORDER BY sy.student_id DESC
                                                    ") or die(mysqli_error($conn));
                                                        while ($row = mysqli_fetch_array($get_enrolled_stud)) {
                                                            $id = $row['student_id'];
                                                            $sy_id = $row['sy_id'];
                                                            $_SESSION['stud_no'] = $row['stud_no'];
                                                            $_SESSION['orig_id'] = $row['student_id'];
                                                            $glvl_id = $row['grade_level_id'];



                                                ?>
                                                <tr>
                                                    <td>

                                                        <?php
                                                                    $_SESSION['orig_id'] = $row['student_id'];
                                                                    if (!empty(base64_encode($row['img']))) {
                                                                        echo '
                                                        <img src="data:image/jpeg;base64,'  . base64_encode($row['img']) . '"
                                                        class="img zoom " alt="User image"
                                                        style="height: 80px; width: 100px">';
                                                                    } else {
                                                                        echo ' <img src="../../../assets/img/red_user.jpg" class="img zoom"
                                                            alt="User image" style="height: 80px; width: 100px">';
                                                                    } ?>
                                                    </td>
                                                    <td><?php echo $row['stud_no']; ?></td>
                                                    <td><?php echo $row['fullname']; ?></td>
                                                    <?php if (empty($row['strand_def'])) {
                                                                    echo '<td>Grade School</td>';
                                                                } else {
                                                                    echo '<td>' . $row['strand_def'] . '</td>';
                                                                } ?>
                                                    <td><?php echo $row['grade_level']; ?></td>
                                                    <td><?php echo $row['stud_type']; ?></td>
                                                    <td><?php echo $row['date_enrolled']; ?></td>
                                                    <td>
                                                        <p class="bg-gray-light rounded p-1 mb-0 text-center">
                                                            <i>
                                                                <?php echo $row['remark']; ?>
                                                            </i>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="userData/ctrl.editEnrolledStud.php?id=<?php echo $sy_id; ?>"
                                                            method="POST">


                                                            <div class="btn-group">
                                                                <?php if ($_SESSION['role'] == "Accounting") {
                                                                                if (
                                                                                    $row['remark'] == 'Confirmed' || $row['remark'] ==
                                                                                    'Disapproved'
                                                                                ) {
                                                                                    echo '<button type="submit"
                                                                    class="btn btn-success text-sm p-2 mb-md-2"
                                                                    name="sub_remark"><i class="fas fa-check"> </i>
                                                                    Approve</button>
                                                                <button type="button"
                                                                    class="btn btn-success text-sm p-2 mb-md-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                    data-toggle="dropdown">
                                                                    <span class="sr-only">Options</span>
                                                                </button>';
                                                                                } else if ($row['remark'] == 'Approved') {
                                                                                    echo ' <button type="submit"
                                                                    class="btn bg-orange text-sm  p-2 mb-md-2"
                                                                    name="sub_remark"
                                                                    style="color: white !important;"><i
                                                                        class="fas fa-times"></i> Disapprove</button>
                                                                <button type="button"
                                                                    class="btn bg-orange text-sm p-2 mb-md-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                    style="color: white !important;"
                                                                    data-toggle="dropdown">
                                                                    <span class="sr-only">Options</span>
                                                                </button>';
                                                                                }
                                                                            } else {
                                                                                if (
                                                                                    $row['remark'] == 'Pending' || $row['remark'] ==
                                                                                    'Canceled'
                                                                                ) {
                                                                                    echo '<button type="submit"
                                                                    class="btn btn-success text-sm p-2 mb-md-2"
                                                                    name="sub_remark"><i class="fas fa-check"></i>
                                                                    Confirm</button>
                                                                <button type="button"
                                                                    class="btn btn-success text-sm p-2 mb-md-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                    data-toggle="dropdown">
                                                                    <span class="sr-only">Options</span>
                                                                </button>';
                                                                                } elseif (
                                                                                    $row['remark'] == 'Confirmed' ||
                                                                                    $row['remark'] == 'Disapproved'
                                                                                ) {
                                                                                    echo ' <button type="submit"
                                                                    class="btn bg-orange text-sm  p-2 mb-md-2"
                                                                    name="sub_remark"
                                                                    style="color: white !important;"><i
                                                                        class="fas fa-times"></i>
                                                                    Cancel</button>
                                                                <button type="button"
                                                                    class="btn bg-orange text-sm p-2 mb-md-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                    style="color: white !important;"
                                                                    data-toggle="dropdown">
                                                                    <span class="sr-only">Options</span>
                                                                </button>';
                                                                                }
                                                                            } ?>

                                                        </form>

                                                        <div class="dropdown-menu dropdown-menu-right text-center"
                                                            role="menu">
                                                            <a href="edit.enrolledStud.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button"
                                                                class=" btn bg-lightblue text-sm p-2 mb-md-2"><i
                                                                    class="fa fa-edit"></i>
                                                                Update
                                                            </a>

                                                            <a href="../bed-subjects/list.enrolledSubSH.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button"
                                                                class=" btn bg-gray text-sm p-2 mb-md-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Subjects
                                                            </a>

                                                            <a href="../bed-forms/pre-en-data.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button" class=" btn bg-purple text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Pre-Enroll
                                                            </a>
                                                            <a href="../bed-forms/laspi-form.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Main Reg Form
                                                            </a>
                                                            <?php if (!empty($glvl_id)) { ?>
                                                            <a href="../bed-forms/all_formsSH.php?<?php echo 'stud_id=' . $id . '&glvl_id=' . $glvl_id; ?>"
                                                                type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Reg Form
                                                            </a>
                                                            
                                                            <?php } else { ?>
                                                            <a href="../bed-forms/all_formsSH.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Reg Form
                                                            </a>
                                                            <?php } ?>

                                                            <!-- Button trigger modal -->
                                                            <div class="dropdown-divider"></div>
                                                            <a type="button" class="btn bg-red text-sm p-2 mb-md-2"
                                                                data-toggle="modal"
                                                                data-target="#exampleModal<?php echo $id ?>"><i
                                                                    class="fa fa-trash"></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-red">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                        Confirm Delete
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-3">
                                                    Are you sure you want to delete
                                                    <?php echo $row['fullname']; ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="userData/ctrl.delEnrolledStud.php?<?php echo 'sy_id=' . $sy_id; ?>"
                                                        type="button" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                    </tr>


                                    <?php }
                                                    }
                                                } else {
                                                    $get_enrolled_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_lname, ', ', stud.student_fname, ' ', stud.student_mname) AS fullname 
                                                FROM tbl_schoolyears AS sy
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                                                LEFT JOIN tbl_strands AS stds ON stds.strand_id = sy.strand_id
                                                LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id =sy.grade_level_id
                                                LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id  
                                                WHERE remark NOT IN ('Approved') AND ay.academic_year = '$_SESSION[active_acadyears]' AND (sem.semester = '$_SESSION[active_semester]' OR sy.semester_id = '0')    
                                                ORDER BY sy.student_id DESC
                                                ") or die(mysqli_error($conn));

                                                    while ($row = mysqli_fetch_array($get_enrolled_stud)) {
                                                        $id = $row['student_id'];
                                                        $sy_id = $row['sy_id'];
                                                        $_SESSION['stud_no'] = $row['stud_no'];
                                                        $_SESSION['orig_id'] = $row['student_id'];
                                                        $glvl_id = $row['grade_level_id'];

                                ?>
                                    <tr>
                                        <td>

                                            <?php
                                                        $_SESSION['orig_id'] = $row['student_id'];
                                                        if (!empty(base64_encode($row['img']))) {
                                                            echo '
                                                        <img src="data:image/jpeg;base64,'  . base64_encode($row['img']) . '"
                                                        class="img zoom " alt="User image"
                                                        style="height: 80px; width: 100px">';
                                                        } else {
                                                            echo ' <img src="../../../assets/img/red_user.jpg" class="img zoom"
                                                            alt="User image" style="height: 80px; width: 100px">';
                                                        } ?>
                                        </td>
                                        <td><?php echo $row['stud_no']; ?></td>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <?php if (empty($row['strand_def'])) {
                                                            echo '<td>Grade School</td>';
                                                        } else {
                                                            echo '<td>' . $row['strand_def'] . '</td>';
                                                        } ?>
                                        <td><?php echo $row['grade_level']; ?></td>
                                        <td><?php echo $row['stud_type']; ?></td>
                                        <td><?php echo $row['date_enrolled']; ?></td>
                                        <td>
                                            <p class="bg-gray-light rounded p-1 mb-0 text-center">
                                                <i>
                                                    <?php echo $row['remark']; ?>
                                                </i>
                                            </p>
                                        </td>
                                        <td>
                                            <form action="userData/ctrl.editEnrolledStud.php?id=<?php echo $sy_id; ?>"
                                                method="POST">


                                                <div class="btn-group dropleft">
                                                    <?php if ($_SESSION['role'] == "Accounting") {
                                                            if ($row['remark'] == 'Confirmed' || $row['remark'] == 'Disapproved') {
                                                                echo '<button type="submit"
                                                                class="btn btn-success text-sm p-2 mb-2"
                                                                name="sub_remark"><i class="fas fa-check"> </i>
                                                                  Approve</button>
                                                                <button type="button"
                                                                class="btn btn-success text-sm p-2 mb-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                data-toggle="dropdown">
                                                                <span class="sr-only">Options</span>
                                                            </button>';
                                                            } else if ($row['remark'] == 'Approved') {
                                                                echo ' <button type="submit" class="btn bg-orange text-sm  p-2 mb-2"
                                                                            name="sub_remark" style="color: white !important;"><i
                                                                                class="fas fa-times"></i> Disapprove</button>
                                                                        <button type="button"
                                                                            class="btn bg-orange text-sm p-2 mb-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                            style="color: white !important;" data-toggle="dropdown">
                                                                            <span class="sr-only">Options</span>
                                                                        </button>';
                                                            }
                                                        } else {
                                                            if ($row['remark'] == 'Pending' || $row['remark'] == 'Canceled') {
                                                                echo '<button type="submit"
                                                                class="btn btn-success text-sm p-2 mb-2"
                                                                name="sub_remark"><i class="fas fa-check"></i>
                                                                Confirm</button>
                                                                <button type="button"
                                                                class="btn btn-success text-sm p-2 mb-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                data-toggle="dropdown">
                                                                <span class="sr-only">Options</span>
                                                            </button>';
                                                            } elseif ($row['remark'] == 'Confirmed' || $row['remark'] == 'Disapproved') {
                                                                echo ' <button type="submit" class="btn bg-orange text-sm  p-2 mb-2"
                                                                        name="sub_remark" style="color: white !important;"><i
                                                                            class="fas fa-times"></i>
                                                                        Cancel</button>
                                                                    <button type="button"
                                                                        class="btn bg-orange text-sm p-2 mb-2 dropdown-toggle dropdown-hover dropdown-icon"
                                                                        style="color: white !important;" data-toggle="dropdown">
                                                                        <span class="sr-only">Options</span>
                                                                    </button>';
                                                            }
                                                        } ?>

                                            </form>

                                            <div class="dropdown-menu dropdown-menu-left text-center" role="menu">
                                                <a href="edit.enrolledStud.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn bg-lightblue text-sm p-2 mb-2"><i
                                                        class="fa fa-edit"></i>
                                                    Update
                                                </a>

                                                <a href="../bed-subjects/list.enrolledSubSH.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn bg-gray text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Subjects
                                                </a>

                                                <a href="../bed-forms/pre-en-data.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn bg-purple text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Pre-Enroll
                                                </a>
                                                <!-- <a href="../bed-forms/accounting-laspi-shs.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Main Reg Form
                                                </a>
                                                <a href="../bed-forms/accounting-laspi-k10.php?<?php echo 'stud_id=' . $id; ?>"
                                                                type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                                    class="fa fa-eye"></i>
                                                                Main1 Reg Form
                                                </a> -->

                                                <?php if (!empty($glvl_id)) { ?>
                                                <a href="../bed-forms/accounting-laspi-shs.php?<?php echo 'stud_id=' . $id . '&glvl_id=' . $glvl_id; ?>"
                                                    type="button" class=" btn btn-success text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Reg Form Main
                                                </a>
                                                <?php } else { ?>
                                                <a href="../bed-forms/accounting-laspi-shs.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn btn-success text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Reg Form Main
                                                </a>
                                                <?php } ?>

                                                <?php if (!empty($glvl_id)) { ?>
                                                <a href="../bed-forms/bed-accountingSHS.php?<?php echo 'stud_id=' . $id . '&glvl_id=' . $glvl_id; ?>"
                                                    type="button" class=" btn btn-warning text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Accounting Form
                                                </a>
                                                <?php } else { ?>
                                                <a href="../bed-forms/bed-accountingSHS.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn btn-warning text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Accounting Form
                                                </a>
                                                <?php } ?>

                                                <?php if (!empty($glvl_id)) { ?>
                                                <a href="../bed-forms/all_formsSH.php?<?php echo 'stud_id=' . $id . '&glvl_id=' . $glvl_id; ?>"
                                                    type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Reg Form
                                                </a>
                                                <?php } else { ?>
                                                <a href="../bed-forms/all_formsSH.php?<?php echo 'stud_id=' . $id; ?>"
                                                    type="button" class=" btn bg-maroon text-sm p-2 mb-2"><i
                                                        class="fa fa-eye"></i>
                                                    Reg Form
                                                </a>
                                                <?php } ?>


                                                <!-- Button trigger modal -->
                                                <div class="dropdown-divider"></div>
                                                <a type="button" class="btn bg-red text-sm p-2 mb-2" data-toggle="modal"
                                                    data-target="#exampleModal<?php echo $id ?>"><i
                                                        class="fa fa-trash"></i>
                                                    Delete
                                                </a>
                                            </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-red">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                    Confirm Delete
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-3">
                                                Are you sure you want to delete
                                                <?php echo $row['fullname']; ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="userData/ctrl.delEnrolledStud.php?<?php echo 'sy_id=' . $sy_id; ?>"
                                                    type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                </tr>
                                <?php
                                                    }
                                                }
                        ?>
                                </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- END TABLES -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Footer and script -->
    <?php include '../../includes/bed-footer.php';
    if (isset($_SESSION['success-del'])) {
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
            title: 'Successfully Deleted.'
            })
            }); 
            </script>";
    }
    unset($_SESSION['success-del']);
    ?>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>


</body>

</html>