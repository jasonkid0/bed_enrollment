<?php
require '../../includes/conn.php';
session_start();
ob_start();

if ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") {
    $stud_id = $_GET['stud_id'];
    $_SESSION['studtID'] = $stud_id;

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
    } else {

        $get_level_id = mysqli_query($conn, "SELECT * FROM tbl_schoolyears
        WHERE student_id = '$stud_id' AND semester_id = '$sem' AND ay_id = '$acad'") or die(mysqli_error($conn));
        $result2 = mysqli_num_rows($get_level_id);

        if ($result2 > 0) {
            header('location: ../bed-404/page404.php');
        } else {
            header('location: ../bed-404/page404.php');
        }
    }
}

require '../../includes/bed-session.php';



$get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', LEFT(stud.student_mname,1), '. ', stud.student_lname) AS fullname 
FROM tbl_schoolyears AS sy
LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND sy.semester_id = '0'") or die(mysqli_error($conn));
if ($_SESSION['role'] == "Student") {
    $result = mysqli_num_rows($get_stud);
    if ($result == 0) {
        header('location: ../bed-student/add.enroll.php');
    }
}
while ($row = mysqli_fetch_array($get_stud)) {
    $rem = $row['remark'];
}
if ($_SESSION['role'] == "Student") {
    if ($rem == "Canceled" || $rem == "Pending") {
    } else {
        header('location: list.enrolledSubPJH.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>Enrollment Information | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Subjects List</a>
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
                                        <h3 class="card-title text-lg">Select Your Subjects</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php if ($_SESSION['role'] == "Student") { ?>
                                        <form action="userData/ctrl.list.offeredSubPJH.php" method="POST">
                                            <?php } elseif ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") { ?>
                                            <form
                                                action="userData/ctrl.list.offeredSubPJH.php?stud_id=<?php echo $stud_id; ?>"
                                                method="POST">
                                                <?php } ?>
                                                <table id="example2" class="table table-hover">
                                                    <thead class="bg-gray-light">
                                                        <tr>
                                                            <th></th>
                                                            <th>Code</th>
                                                            <th>Description</th>
                                                            <th>Grade Level</th>
                                                            <th>Days</th>
                                                            <th>Time</th>
                                                            <th>Room</th>
                                                            <th>Professor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border-bottom">
                                                        <?php
                                                        $get_grade_lvl = mysqli_query($conn, "SELECT * FROM tbl_schoolyears AS sy
                                                    LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
                                                    WHERE student_id = '$stud_id' AND semester_id = '0' AND ay.academic_year = '$_SESSION[active_acadyears]'") or die(mysqli_error($conn));
                                                        while ($row = mysqli_fetch_array($get_grade_lvl)) {
                                                            $glvlID = $row['grade_level_id'];
                                                        }


                                                        $get_offerSub = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teach.teacher_lname) AS fullname FROM tbl_schedules AS sched
                                                LEFT JOIN tbl_subjects AS sub ON sub.subject_id = sched.subject_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                WHERE sched.schedule_id NOT IN (SELECT sched.schedule_id FROM tbl_enrolled_subjects AS ensub
                                                    INNER JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                                                    WHERE student_id = '$stud_id') AND (semester = '0' AND sched.grade_level_id = '$glvlID' AND acadyear = '$_SESSION[active_acadyears]') ORDER BY sub.grade_level_id ASC, schedule_id DESC") or die(mysqli_error($conn));


                                                        $index = 0;
                                                        while ($row = mysqli_fetch_array($get_offerSub)) {

                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="studID[]"
                                                                    value="<?php echo $stud_id ?>" hidden>
                                                                <input type="text" name="sched_id[]"
                                                                    value="<?php echo $row['schedule_id']; ?>" hidden>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input
                                                                        class="custom-control-input custom-control-input-navy"
                                                                        type="checkbox"
                                                                        id="customCheckbox4<?php echo $row['schedule_id'] ?>"
                                                                        name="checked[]"
                                                                        value="<?php echo $index++; ?>">
                                                                    <label
                                                                        for="customCheckbox4<?php echo $row['schedule_id'] ?>"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $row['subject_code']; ?></td>
                                                            <td><?php echo $row['subject_description']; ?></td>
                                                            <td><?php echo $row['grade_level']; ?></td>
                                                            <td><?php echo $row['day']; ?></td>
                                                            <td><?php echo $row['time']; ?></td>
                                                            <td><?php echo $row['room']; ?></td>
                                                            <?php if (empty($row['fullname'])) { ?>
                                                            <td>TBA</td>
                                                            <?php } else { ?>
                                                            <td><?php echo $row['fullname']; ?></td>
                                                            <?php } ?>

                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <hr class="bg-navy">

                                                <div class="row justify-content-end float-right">

                                                    <div class="ml-1">
                                                        <button name=" submit"
                                                            class="btn btn-default bg-lightblue p-2"><i
                                                                class="fa fa-plus">
                                                            </i>
                                                            Add Selected</button>
                                                    </div>
                                            </form>
                                            <?php if ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") { ?>
                                            <div class="ml-2">
                                                <a href="list.enrolledSubPJH.php?stud_id=<?php echo $stud_id; ?>"
                                                    class="btn btn-default bg-gray p-2"><i
                                                        class="fa fa-arrow-circle-left">
                                                    </i>
                                                    Back</a>
                                            </div>
                                            <?php } else if ($_SESSION['role'] == "Student") { ?>
                                            <div class="ml-2">
                                                <a href="list.enrolledSubPJH.php" class="btn btn-default bg-gray p-2"><i
                                                        class="fa fa-arrow-circle-left">
                                                    </i>
                                                    Back</a>
                                            </div>
                                            <?php  } ?>
                                    </div>

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

    if (isset($_SESSION['empty-check'])) {
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
            title:  'Please select your subjects.'
        });
    });
    </script>";
    }
    unset($_SESSION['empty-check']);
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
        $('#example3').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example4').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            }


        });
    });
    </script>


</body>

</html>