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
    <title>Students List | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Students List</a>
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
                                        <h3 class="card-title text-lg">Students List </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
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

                                        <table id="example2" class="table table-hover">
                                            <thead class="bg-gray-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Student ID</th>
                                                    <th>Fullname</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">

                                                <?php
                                                if (isset($_GET['look'])) {

                                                    $_GET['search'] = addslashes($_GET['search']);
                                                    $_SESSION['search'] = $_GET['search'];

                                                    $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_students.student_lname, ', ', tbl_students.student_fname, ' ', tbl_students.student_mname) AS fullname 
                                                FROM tbl_students
                                                LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_students.gender_id
                                                WHERE (student_fname LIKE '%$_GET[search]%' 
                                                OR student_mname LIKE '%$_GET[search]%'
                                                OR student_lname  LIKE '%$_GET[search]%' 
                                                OR stud_no LIKE '%$_GET[search]%')                         
                                                ORDER BY student_id DESC
                                                ") or die(mysqli_error($conn));
                                                    while ($row = mysqli_fetch_array($get_user)) {
                                                        $id = $row['student_id'];
                                                        $_SESSION['stud_no'] = $row['stud_no'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php if (!empty(base64_encode($row['img']))) {
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
                                                    <td><?php echo $row['gender_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>

                                                    <td><a href="edit.infoStud.php? <?php echo 'stud_id=' . $id ?>"
                                                            type="button"
                                                            class="btn bg-lightblue text-sm p-2 mb-md-2"><i
                                                                class="fa fa-edit"></i>
                                                            Edit Info
                                                        </a>

                                                        <!-- Button trigger modal -->
                                                        <a type="button" class="btn bg-red text-sm p-2 mb-md-2"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal<?php echo $id ?>"><i
                                                                class="fa fa-trash"></i>
                                                            Delete
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo $id ?>"
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
                                                                        <?php echo $row['fullname']; ?>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <a href="userData/ctrl.delStud.php<?php echo '?student_id=' . $id; ?>"
                                                                            type="button"
                                                                            class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }
                                                } ?>
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