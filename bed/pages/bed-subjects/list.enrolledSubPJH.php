<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';
if ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") {
    $stud_id = $_GET['stud_id'];


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
            header('location: list.enrolledSubSH.php?stud_id=' . $stud_id);
        } else {
            header('location: ../bed-404/page404.php');
        }
    }
}


if ($_SESSION['role'] == "Student") {
    $get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', LEFT(stud.student_mname,1), '. ', stud.student_lname) AS fullname 
FROM tbl_schoolyears AS sy
LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND sy.semester_id = '0'") or die(mysqli_error($conn));
    $result = mysqli_num_rows($get_stud);
    if ($result == 0) {
        header('location: ../bed-student/add.enroll.php');
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
                    <a href="#" class="nav-link disabled text-light">Enrollment Info.</a>
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
                                        <h3 class="card-title text-lg">Enrollment Information</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example3" class="table table-avatar"
                                            style="border-bottom: 0 !important; border-radius: 10px ; box-shadow: 0 4px 10px 0 rgb(0 0 0 / 20%), 0 4px 20px 0 rgb(0 0 0 / 19%);">
                                            <thead class="text-navy border-bottom-0 p-5" style="border-radius: 15px;">
                                                <tr>
                                                    <th class="pt-3 pb-3">Student ID:</th>
                                                    <th class=" pt-3 pb-3">Name:</th>
                                                    <th class="pt-3 pb-3">Gender:</th>
                                                    <th class=" pt-3 pb-3">Grade Level:</th>
                                                    <th class="pt-3 pb-3">School Year:</th>
                                                    <th class=" pt-3 pb-3">Date:</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', LEFT(stud.student_mname,1), '. ', stud.student_lname) AS fullname 
                                                FROM tbl_schoolyears AS sy
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                                                LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
                                                LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
                                                LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
                                                LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                                                WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND sy.semester_id = '0'") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($get_stud)) {
                                                    $remark = $row['remark']; ?>
                                                <tr>
                                                    <td class="pt-4 pb-4"><?php echo $row['stud_no']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['fullname']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['gender_name']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['grade_level']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['academic_year']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['date_enrolled']; ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <center>
                                        <div class="card-header bg-navy p-3 col-sm-7 rounded-pill mt-3">

                                            <h5 class="ml-auto mr-auto card-text text-lg">Your Subjects List
                                            </h5>

                                        </div>
                                    </center>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php if ($_SESSION['role'] == "Student") { ?>
                                        <form action="userData/ctrl.del.list.offeredSubPJH.php" method="POST">
                                            <?php } elseif ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") { ?>
                                            <form
                                                action="userData/ctrl.del.list.offeredSubPJH.php?stud_id=<?php echo $stud_id; ?>"
                                                method="POST">
                                                <?php } ?>
                                                <table id="example4" class="table table-hover"
                                                    style="box-shadow: 0 4px 10px 0 rgb(0 0 0 / 20%), 0 4px 20px 0 rgb(0 0 0 / 19%);">
                                                    <thead class="bg-gray-light">
                                                        <tr>
                                                            <th></th>
                                                            <th>Code</th>
                                                            <th>Description</th>
                                                            <th>Days</th>
                                                            <th>Time</th>
                                                            <th>Room</th>
                                                            <th>Professor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $get_enrolled_sub = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teach.teacher_lname) AS fullname FROM tbl_enrolled_subjects AS ensub
                                                         LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                                                         LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
                                                         LEFT JOIN tbl_subjects AS sub ON sub.subject_id = sched.subject_id
                                                         LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                         LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                         WHERE stud.student_id = $stud_id AND sched.semester = '0'") or die(mysqli_error($conn));
                                                        $index = 0;
                                                        while ($row = mysqli_fetch_array($get_enrolled_sub)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php if ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") { ?>
                                                                <div
                                                                    class="custom-control custom-checkbox justify-content-center">
                                                                    <input type="text" name="enrolled_subID[]"
                                                                        value="<?php echo $row['enrolled_sub_id'] ?>"
                                                                        hidden>
                                                                    <input
                                                                        class="custom-control-input custom-control-input-navy"
                                                                        type="checkbox" name="checked[]"
                                                                        value="<?php echo $index++; ?>"
                                                                        id="customCheckbox4<?php echo $row['enrolled_sub_id'] ?>">
                                                                    <label
                                                                        for="customCheckbox4<?php echo $row['enrolled_sub_id'] ?>"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                                <?php } else if ($_SESSION['role'] == "Student") {
                                                                        if ($remark == 'Canceled' || $remark == 'Pending') { ?>

                                                                <div
                                                                    class="custom-control custom-checkbox justify-content-center">
                                                                    <input type="text" name="enrolled_subID[]"
                                                                        value="<?php echo $row['enrolled_sub_id'] ?>"
                                                                        hidden>
                                                                    <input
                                                                        class="custom-control-input custom-control-input-navy"
                                                                        type="checkbox" name="checked[]"
                                                                        value="<?php echo $index++; ?>"
                                                                        id="customCheckbox4<?php echo $row['enrolled_sub_id'] ?>">
                                                                    <label
                                                                        for="customCheckbox4<?php echo $row['enrolled_sub_id'] ?>"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                                <?php }
                                                                    } ?>
                                                            </td>
                                                            <td><?php echo $row['subject_code']; ?></td>
                                                            <td><?php echo $row['subject_description']; ?></td>
                                                            <td><?php echo $row['day']; ?></td>
                                                            <td><?php echo $row['time']; ?></td>
                                                            <td><?php echo $row['room']; ?></td>
                                                            <td><?php if (empty($row['fullname'])) {
                                                                        echo "TBA";
                                                                    } else {
                                                                        echo $row['fullname'];
                                                                    }  ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <?php
                                                    $get_enrolled_sub = mysqli_query($conn, "SELECT COUNT(sub.subject_id) AS csub FROM tbl_enrolled_subjects AS ensub
                                                LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
                                                LEFT JOIN tbl_subjects AS sub ON sub.subject_id = sched.subject_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                WHERE stud.student_id = $stud_id AND sched.semester = '0'") or die(mysqli_error($conn));
                                                    $index = 0;
                                                    while ($row = mysqli_fetch_array($get_enrolled_sub)) {
                                                        if (!empty($row['csub'])) { ?>

                                                    <tfoot>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td>Total Subjects:</td>
                                                                <td><?php echo '(' . $row['csub'] . ')' ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </tfoot>
                                                    <?php }
                                                    } ?>
                                                </table>
                                                <?php if ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") { ?>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <?php if ($_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar") { ?>
                                                        <a href="../bed-student/list.enrolledStud.php?search=<?php echo $_SESSION['search']; ?>&look="
                                                            class="btn btn-default bg-gray p-2">
                                                            <?php } else { ?>
                                                            <a href="../bed-student/list.enrolledStud.php"
                                                                class="btn btn-default bg-gray p-2">
                                                                <?php } ?>
                                                                <i class="fa fa-arrow-circle-left">
                                                                </i>
                                                                Back</a>
                                                    </div>


                                                    <div class="ml-auto mr-1">
                                                        <a href="list.offeredSubPJH.php?stud_id=<?php echo $stud_id; ?>"
                                                            class="btn btn-default bg-lightblue p-2"><i
                                                                class="fa fa-plus">
                                                            </i>
                                                            Add Subjects</a>



                                                        <button name="submit" class="btn btn-default bg-red p-2"><i
                                                                class="fa fa-trash-alt">
                                                            </i>
                                                            Drop Selected</a>
                                                        </button>
                                                    </div>

                                                </div>
                                                <?php  } elseif ($_SESSION['role'] == "Student") {
                                                    if ($remark == 'Canceled' || $remark == 'Pending') { ?>
                                                <hr>
                                                <div class="row justify-content-end float-right">
                                                    <div class="ml-1">
                                                        <a href="list.offeredSubPJH.php"
                                                            class="btn btn-default bg-lightblue p-2"><i
                                                                class="fa fa-plus">
                                                            </i>
                                                            Add Subjects</a>
                                                    </div>

                                                    <div class="ml-2">
                                                        <button name="submit" class="btn btn-default bg-red p-2"><i
                                                                class="fa fa-trash-alt">
                                                            </i>
                                                            Drop Selected</a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php }
                                                } ?>

                                            </form>
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
            } elseif (isset($_SESSION['drop'])) {
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
            title: 'Successfully Dropped.'
            })
            }); 
            </script>";
            }
            unset($_SESSION['empty-check']);
            unset($_SESSION['drop']);
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
                    "info": false,
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