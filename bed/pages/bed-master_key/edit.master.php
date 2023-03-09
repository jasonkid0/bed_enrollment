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
    <title>Update Master Key | SFAC Bacoor</title>
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
                    <a href="#" class="nav-link disabled text-light">Edit Master Key</a>
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
                                <h3 class="card-title">Master Key Update Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php
                            $get_userInfo = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE mk_id = '$mk_id'");

                            while ($row = mysqli_fetch_array($get_userInfo)) { ?>
                            <form action="userData/ctrl.editMaster.php<?php echo '?mk_id=' . $mk_id; ?>"
                                enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="form-group mb-4">


                                        <div class="custom-file mt-4">
                                            <div class="img text-center">
                                                <img class="img-bordered img-circle p-1 m-1"
                                                    src="data:image/jpeg;base64, <?php echo base64_encode($row['img']); ?> "
                                                    alt="User profile picture" style="width: 145px; height: 145px;">
                                            </div>


                                            <div class="row">
                                                <div class="form-group mr-auto ml-auto col-md-4">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input"
                                                                id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                image</label>
                                                        </div><button type="submit" name="upload"
                                                            class="btn bg-purple btn-default"><i
                                                                class="fa fa-image"></i>
                                                            Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-4 mt-5">
                                        <div class="input-group col-sm-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="<?php echo $row['name']; ?>">
                                        </div>


                                        <div class="input-group col-sm-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" value="<?php echo $row['email']; ?>"
                                                required>
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <div class="input-group col-sm-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Username" value="<?php echo $row['username']; ?>" required>
                                        </div>

                                        <div class="input-group col-sm-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                        </div>


                                        <div class="input-group col-sm-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="password2"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <?php } ?>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn bg-purple btn-default"><i
                                            class="fa fa-user-check"></i> Update</button>
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
            if (isset($_SESSION['success-mkEdit'])) {
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
            } elseif (isset($_SESSION['no-img'])) {
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
                    timer: 2000
                });
                $('.swalDefaultError')
                Toast.fire({
                    icon: 'error',
                    title:  'The Password field is required. Please try again.'
                });
            });
            </script>";
            }
            unset($_SESSION['no-pwd']);
            unset($_SESSION['success-mkEdit']);
            unset($_SESSION['no-img']);  ?>

</body>

</html>