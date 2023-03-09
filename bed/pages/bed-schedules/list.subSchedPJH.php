<?php
require '../../includes/conn.php';
session_start();
ob_start();


require '../../includes/bed-session.php';

if (!empty($_GET['eay'])) {
    $efacadyear = $_GET['eay'];
}


if (isset($_GET['g1'])) {
    $grd_lvl = $_GET['g1'];
} elseif (isset($_GET['g2'])) {
    $grd_lvl = $_GET['g2'];
} elseif (isset($_GET['g3'])) {
    $grd_lvl = $_GET['g3'];
} elseif (isset($_GET['g4'])) {
    $grd_lvl = $_GET['g4'];
} elseif (isset($_GET['g5'])) {
    $grd_lvl = $_GET['g5'];
} elseif (isset($_GET['g6'])) {
    $grd_lvl = $_GET['g6'];
} elseif (isset($_GET['g7'])) {
    $grd_lvl = $_GET['g7'];
} elseif (isset($_GET['g8'])) {
    $grd_lvl = $_GET['g8'];
} elseif (isset($_GET['g9'])) {
    $grd_lvl = $_GET['g9'];
} elseif (isset($_GET['g10'])) {
    $grd_lvl = $_GET['g10'];
} elseif (isset($_GET['nurs'])) {
    $grd_lvl = $_GET['nurs'];
} elseif (isset($_GET['pkdr'])) {
    $grd_lvl = $_GET['pkdr'];
} elseif (isset($_GET['kdr'])) {
    $grd_lvl = $_GET['kdr'];
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
                    <a href="#" class="nav-link disabled text-light">Class Schedule</a>
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

                <!-- tables -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header bg-navy p-3">
                                        <h3 class="card-title">Class Schedule for Grade School
                                            <?php if (isset($_GET['g1'])) {
                                                echo '(Grade 1)';
                                            } elseif (isset($_GET['g2'])) {
                                                echo ' (Grade 2)';
                                            } elseif (isset($_GET['g3'])) {
                                                echo ' (Grade 3)';
                                            } elseif (isset($_GET['g4'])) {
                                                echo ' (Grade 4)';
                                            } elseif (isset($_GET['g5'])) {
                                                echo ' (Grade 5)';
                                            } elseif (isset($_GET['g6'])) {
                                                echo ' (Grade 6)';
                                            } elseif (isset($_GET['g7'])) {
                                                echo ' (Grade 7)';
                                            } elseif (isset($_GET['g8'])) {
                                                echo ' (Grade 8)';
                                            } elseif (isset($_GET['g9'])) {
                                                echo ' (Grade 9)';
                                            } elseif (isset($_GET['g10'])) {
                                                echo ' (Grade 10)';
                                            } elseif (isset($_GET['nurs'])) {
                                                echo ' (Nursery)';
                                            } elseif (isset($_GET['pkdr'])) {
                                                echo ' (Pre-Kinder)';
                                            } elseif (isset($_GET['kdr'])) {
                                                echo ' (Kinder)';
                                            } else {
                                                echo '';
                                            } ?>
                                        </h3>

                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="GET">

                                            <div class="row justify-content-center">
                                                <button class="btn btn-app bg-gray-light" value="Grade 1" name="g1">
                                                    <i class="fas fa-list-alt"></i> Grade 1
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 2" name="g2">
                                                    <i class="fas fa-list-alt"></i> Grade 2
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 3" name="g3">
                                                    <i class="fas fa-list-alt"></i> Grade 3
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 4" name="g4">
                                                    <i class="fas fa-list-alt"></i> Grade 4
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 5" name="g5">
                                                    <i class="fas fa-list-alt"></i> Grade 5
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 6" name="g6">
                                                    <i class="fas fa-list-alt"></i> Grade 6
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 7" name="g7">
                                                    <i class="fas fa-list-alt"></i> Grade 7
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 8" name="g8">
                                                    <i class="fas fa-list-alt"></i> Grade 8
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 9" name="g9">
                                                    <i class="fas fa-list-alt"></i> Grade 9
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Grade 10" name="g10">
                                                    <i class="fas fa-list-alt"></i> Grade 10
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Nursery" name="nurs">
                                                    <i class="fas fa-list-alt"></i> Nursery
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Pre-Kinder"
                                                    name="pkdr">
                                                    <i class="fas fa-list-alt"></i> Pre-Kinder
                                                </button>

                                                <button class="btn btn-app bg-gray-light" value="Kinder" name="kdr">
                                                    <i class="fas fa-list-alt"></i> Kinder
                                                </button>
                                            </div>

                                        </form>

                                        <hr class="bg-navy">
                                        <table id="example2" class="table table-hover">
                                            <thead class="bg-gray-light">
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Description</th>
                                                    <th>Day</th>
                                                    <th>Time</th>
                                                    <th>Room</th>
                                                    <th>Teacher</th>
                                                    <th>Grade Level</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">
                                                <?php
                                                if (!empty($grd_lvl)) {

                                                    $act_acad = $_SESSION['active_acadyears'];
                                                    $get_sched = mysqli_query($conn, "SELECT *, CONCAT(teach.teacher_fname, ' ', LEFT(teach.teacher_mname,1), '. ', teacher_lname) AS fullname FROM tbl_schedules AS sched
                                                    LEFT JOIN tbl_subjects AS sub ON sub.subject_id = sched.subject_id             
                                                    LEFT JOIN tbl_grade_levels AS gl1 ON gl1.grade_level_id = sched.grade_level_id
                                                    LEFT JOIN tbl_grade_levels AS gl ON gl.grade_level_id = sub.grade_level_id
                                                    LEFT JOIN tbl_teachers AS teach ON teach.teacher_id = sched.teacher_id
                                                WHERE gl1.grade_level IN ('$grd_lvl') AND sched.semester = '0' AND sched.acadyear = '$act_acad' ORDER BY gl.grade_level ASC, sched.subject_id") or die(mysqli_error($conn));

                                                    // 
                                                    // 

                                                ?>


                                                <tr>
                                                    <?php while ($row = mysqli_fetch_array($get_sched)) {
                                                            $id = $row['subject_id'];
                                                            $sched_id = $row['schedule_id'];

                                                        ?>
                                                    <td><?php echo $row['subject_code']; ?></td>
                                                    <td><?php echo $row['subject_description']; ?></td>
                                                    <td><?php echo $row['day']; ?></td>
                                                    <td><?php echo $row['time']; ?></td>
                                                    <td><?php echo $row['room']; ?></td>
                                                    <td><?php if (!empty($row['fullname'])) {
                                                                    echo $row['fullname'];
                                                                } else {
                                                                    echo 'TBA';
                                                                } ?>
                                                    </td>
                                                    <td><?php echo $row['grade_level']; ?></td>
                                                    <td><a href="edit.subSchedPJH.php<?php echo '?sub_id=' . $id . '&sched_id=' . $sched_id; ?>"
                                                            type="button"
                                                            class="btn bg-lightblue text-sm p-2 mb-md-2"><i
                                                                class="fa fa-pen-alt mr-1"></i>
                                                            Update
                                                        </a>

                                                        <a type="button" class="btn bg-red text-sm p-2 mb-md-2"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal<?php echo $sched_id ?>"><i
                                                                class="fa fa-trash"></i>
                                                            Delete
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo $sched_id ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-red">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            <i class="fa fa-exclamation-triangle"></i>
                                                                            Confirm Delete
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body p-3">
                                                                        Are you sure you want to delete
                                                                        <?php echo $row['subject_code'] . ', ' . $row['subject_description']; ?>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <a href="subjectsData/ctrl.delsubSchedPJH.php<?php echo '?sched_id=' . $sched_id . '&grd_lvl=' . $grd_lvl; ?>"
                                                                            type="button"
                                                                            class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr><?php }
                                                    }
                                                            ?>

                                            </tbody>
                                        </table>
                                        <!-- END TABLE -->



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
                    "language": {
                        "emptyTable": "No data available in table.",
                    }


                });
            });
            </script>


</body>

</html>