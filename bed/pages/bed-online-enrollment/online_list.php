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
    <title>SFAC | ONLINE INQUIRIES</title>
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
                    <a href="#" class="nav-link disabled text-light">Online Inquiries</a>
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
                                        <h3 class="card-title text-lg">Online Inquiries</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-hover">
                                            <thead class="bg-gray-light">
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>Grade</th>
                                                    <th>Email</th>
                                                    <th>Student Type</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_online_reg.student_lname, ', ', tbl_online_reg.student_fname, ' ', tbl_online_reg.student_mname) AS fullname FROM tbl_online_reg
                                                    LEFT JOIN tbl_grade_levels ON tbl_grade_levels.grade_level_id = tbl_online_reg.grade_level_id
                                                    LEFT JOIN tbl_strands ON tbl_strands.strand_id = tbl_online_reg.strand_id
                                                    ") or die (mysqli_error($conn)) ?>
                                                <tr>
                                                    <?php while ($row = mysqli_fetch_array($get_user)) {
                                                        $id = $row['or_id'];
                                                    ?>
                                                    <td><?php echo $row['fullname']; ?></td>

                                                    <?php if (empty($row['strand_id'])){
                                                            echo '<td>' .$row['grade_level']. '</td>';
                                                        } else {
                                                            echo '<td>' .$row['grade_level']. ' - ' .$row['strand_name']. '</td>';
                                                        }
                                                    ?>

                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['stud_type']; ?></td>
                                                    <td><?php echo $row['remark']; ?></td>

                                                    <td>
                                                        <?php  if (empty($row['strand_id'])){ ?>
                                                            <a href="online_edit.php<?php echo '?or_id=' . $id; ?>"
                                                            type="button"
                                                            class="btn bg-green text-sm p-2 mb-md-2"><i
                                                                class="fa fa-edit"></i>
                                                            Approve
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="online_edit_senior.php<?php echo '?or_id=' . $id; ?>"
                                                            type="button"
                                                            class="btn bg-green text-sm p-2 mb-md-2"><i
                                                                class="fa fa-edit"></i>
                                                            Approve
                                                            </a>
                                                        <?php } ?>

                                                        
                                                        <?php  if (empty($row['strand_id'])){ ?>
                                                            <a href="../bed-forms/pre_en_online.php<?php echo '?or_id=' . $id; ?>"
                                                            type="button"
                                                            class="btn bg-blue text-sm p-2 mb-md-2"><i
                                                                class="fa fa-edit"></i>
                                                            Pre-enrollment Form
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="../bed-forms/pre_en_online_senior.php<?php echo '?or_id=' . $id; ?>"
                                                            type="button"
                                                            class="btn bg-blue text-sm p-2 mb-md-2"><i
                                                                class="fa fa-edit"></i>
                                                            Pre-enrollment Form
                                                            </a>
                                                        <?php } ?>

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
                                                                        <a href="userData/ctrl.delonline.php<?php echo '?or_id=' . $id; ?>"
                                                                            type="button" name="delete"
                                                                            class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr><?php } ?>
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
                        timer: 3000
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

            if (isset($_SESSION['success-studEdit'])) {
                echo "<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        }); 
$('.swalDefaultSuccess') 
Toast.fire({
icon: 'success',
title: 'Successfully Updated.'
})
}); 
</script>";
            } elseif (isset($_SESSION['no-img'])) {
                echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('.swalDefaultError')
                Toast.fire({
                    icon: 'error',
                    title:  'Upload Failed. Please try again.'
                });
            });
            </script>";
            } elseif (isset($_SESSION['no-pwd'])) {
                echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('.swalDefaultError')
                Toast.fire({
                    icon: 'error',
                    title:  'The Password field is required. Please try again.'
                });
            });
            </script>";
            } elseif (isset($_SESSION['double-studno'])) {
                echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'Student ID already exists.'
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
        timer: 3000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'LRN already exists.'
    });
});
</script>";
            } elseif (isset($_SESSION['lrn-studno'])) {
                echo "<script>
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('.swalDefaultError')
    Toast.fire({
        icon: 'error',
        title:  'Student ID and LRN are already exists.'
    });
});
</script>";
            }
            unset($_SESSION['lrn-studno']);
            unset($_SESSION['double-lrn']);
            unset($_SESSION['double-studno']);
            unset($_SESSION['no-pwd']);
            unset($_SESSION['success-studEdit']);
            unset($_SESSION['no-img']);



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