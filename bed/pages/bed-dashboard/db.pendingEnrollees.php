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
                    <a href="#" class="nav-link disabled text-light">Pending Enrollees</a>

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
                                        <h3 class="card-title text-lg">List of Pending Enrollees </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

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
                                                $get_enrolled_stud = mysqli_query($conn, "SELECT *, CONCAT(stud.student_lname, ', ', stud.student_fname, ' ', stud.student_mname) AS fullname 
                                                FROM tbl_schoolyears AS sy
                                                LEFT JOIN tbl_students AS stud ON stud.student_id = sy.student_id
                                                LEFT JOIN tbl_strands AS stds ON stds.strand_id = sy.strand_id
                                                LEFT JOIN tbl_semesters AS sem ON sem.semester_id = sy.semester_id
                                                LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id =sy.grade_level_id
                                                LEFT JOIN tbl_acadyears AS ay ON ay.ay_id = sy.ay_id  
                                                WHERE (remark = 'Canceled' OR remark = 'Pending') AND ay.academic_year = '$_SESSION[active_acadyears]' AND (sem.semester = '$_SESSION[active_semester]' OR sy.semester_id = '0')    
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


                                                        <a href="../bed-forms/pre-en-data.php?<?php echo 'stud_id=' . $id; ?>"
                                                            type="button" class=" btn bg-purple text-sm p-2 mb-2"><i
                                                                class="fa fa-eye"></i>
                                                            Pre-Enroll
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

                                                    </td>
                                                </tr>
                                                <?php
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