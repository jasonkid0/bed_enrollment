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



if ($_SESSION['role'] == "Student") {

    $get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', LEFT(stud.student_mname,1), '. ', stud.student_lname) AS fullname 
FROM tbl_schoolyears AS sy
LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND sem.semester = '$_SESSION[active_semester]'") or die(mysqli_error($conn));
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
    <title>Dashboard | SFAC Bacoor</title>
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
                                                    <th class="pt-3 pb-3">Student
                                                        ID:</th>
                                                    <th class="pt-3 pb-3">Name:
                                                    </th>
                                                    <th class="pt-3 pb-3">Gender:
                                                    </th>
                                                    <th class="pt-3 pb-3">Grade
                                                        Level:</th>
                                                    <th class="pt-3 pb-3">Strand:
                                                    </th>
                                                    <th class="pt-3 pb-3">School
                                                        Year:</th>
                                                    <th class="pt-3 pb-3">Semester:
                                                    </th>
                                                    <th class="pt-3 pb-3">Date:
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $get_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_fname, ' ', LEFT(stud.student_mname,1), '. ', stud.student_lname) AS fullname 
                                                FROM tbl_schoolyears AS sy
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                                                LEFT JOIN tbl_genders AS gen ON gen.gender_id = stud.gender_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sy.grade_level_id
                                                LEFT JOIN tbl_strands AS std ON std.strand_id = sy.strand_id 
                                                LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id
                                                LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                                                WHERE sy.student_id = '$stud_id' AND ay.academic_year = '$_SESSION[active_acadyears]' AND sem.semester = '$_SESSION[active_semester]'") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($get_stud)) {
                                                    $remark = $row['remark']; ?>
                                                <tr>

                                                    <td class="pt-4 pb-4"><?php echo $row['stud_no']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['fullname']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['gender_name']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['grade_level']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['strand_name']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['academic_year']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['semester']; ?></td>
                                                    <td class="pt-4 pb-4"><?php echo $row['date_enrolled']; ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <center>
                                        <div class=" card-header bg-navy p-3 col-sm-7 rounded-pill mt-3">

                                            <h5 class="ml-auto mr-auto card-text text-lg">Your Subjects List
                                            </h5>

                                        </div>
                                    </center>

                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <table id="example4" class="table table-hover "
                                            style="box-shadow: 0 4px 10px 0 rgb(0 0 0 / 20%), 0 4px 20px 0 rgb(0 0 0 / 19%);">
                                            <thead class="bg-gray-light">
                                                <tr>

                                                    <th>Code</th>
                                                    <th>Description</th>
                                                    <th>Strand</th>
                                                    <th>Unit(s)</th>
                                                    <th>Days</th>
                                                    <th>Time</th>
                                                    <th>Room</th>
                                                    <th>Professor</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">

                                                <?php $get_enrolled_sub = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teach.teacher_lname) AS fullname FROM tbl_enrolled_subjects AS ensub
                                                LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
                                                LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                LEFT JOIN tbl_strands AS strd ON strd.strand_id = sub.strand_id
                                                WHERE stud.student_id = $stud_id AND sched.semester = '$_SESSION[active_semester]' AND sched.acadyear = '$_SESSION[active_acadyears]'") or die(mysqli_error($conn));
                                                $index = 0;
                                                while ($row = mysqli_fetch_array($get_enrolled_sub)) {

                                                ?>
                                                <tr>
                                                    <td><?php echo $row['subject_code']; ?></td>
                                                    <td><?php echo $row['subject_description']; ?></td>
                                                    <td><?php echo $row['strand_name']; ?></td>
                                                    <td><?php echo $row['total_units']; ?></td>
                                                    <td><?php echo $row['day']; ?></td>
                                                    <td><?php echo $row['time']; ?></td>
                                                    <td><?php echo $row['room']; ?></td>
                                                    <td><?php if (empty($row['fullname'])) {
                                                                echo "TBA";
                                                            } else {
                                                                echo $row['fullname'];
                                                            }  ?></td>
                                                </tr>
                                                <?php

                                                } ?>
                                            </tbody>
                                            <?php

                                            $get_enrolled_sub = mysqli_query($conn, "SELECT SUM(sub.total_units) AS units
                                                FROM tbl_enrolled_subjects AS ensub
                                                LEFT JOIN tbl_schedules AS sched ON sched.schedule_id = ensub.schedule_id
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = ensub.student_id
                                                LEFT JOIN tbl_subjects_senior AS sub ON sub.subject_id = sched.subject_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                WHERE stud.student_id = $stud_id AND sched.semester = '$_SESSION[active_semester]' AND sched.acadyear = '$_SESSION[active_acadyears]'") or die(mysqli_error($conn));
                                            $index = 0;
                                            while ($row = mysqli_fetch_array($get_enrolled_sub)) {
                                                if (!empty($row['units'])) {
                                            ?>
                                            <tfoot>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>Total Units</td>
                                                        <td></td>
                                                        <td><?php
                                                                    echo '(' . $row['units'] . ')'; ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </tfoot>

                                            <?php }
                                            }
                                            ?>

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