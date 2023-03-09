<?php
require '../../includes/conn.php';
ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SFAC | Log in</title>
    <link rel="icon" href="../../../assets/img/logo.png" type="image/gif" sizes="16x16">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="../../plugins/toastr/toastr.min.js"></script>


    <!-- Custom css -->
    <style>
    .background {
        background-repeat: no-repeat;
        background-size: cover;
        background-position-x: right;
        background-position: bottom;

    }

    body {
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }

    .toast-top-right {
        right: unset;
        margin-top: 1%;
    }
    </style>
</head>

<body class="hold-transition login-page background"
    style="background-image: url('../../../assets/img/background/bg-4.jpg');">

    <!-- Preloader -->
    <?php
    if (isset($_POST['pre-loader'])) {
        echo ' <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../../assets/img/logo.png" alt="logo-preloader" height="100" width="100">
    </div>';
    } ?>


    <div class="content">
        <!-- /.login-logo -->
        <div class="card-header card-header-tabs border-bottom-0">
            <div class="card card-outline card-red shadow-lg">
                <div class="card-header text-center">
                    <a href="../../../index.php" class="h1"><img height="90" width="90"
                            src="../../../assets/img/logo.png" alt="logo-signin"></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Saint Francis of Assisi College Bacoor Campus</p>

                    <section class="content">
                    <div class="container-fluid pl-5 pr-5 pb-3">
                        <div class="card card-purple shadow-lg">

                            <div class="card-header text-center">
                                <h3 class="text-lg" style="margin-bottom: unset;">
                                    REGISTRATION FORM
                                </h3>
                            </div>
                            <form action="userData/ctrl.addonline.php" enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="form-group row mb-3 mt-3">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Student Type</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Student Type" name="studtype">
                                                <option selected disabled></option>
                                                <option value="New">New Student</option>
                                                <option value="Old">Old Student</option>
                                            </select>

                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Grade</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Grade" name="grade">
                                                <option selected disabled></option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tbl_grade_levels LIMIT 13, 2");
                                                    while($row = mysqli_fetch_array($query)) {
                                                        echo '<option value="'.$row['grade_level_id'].'">'.$row['grade_level'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Strand</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Strand" name="strand">
                                                <option selected disabled></option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tbl_strands");
                                                    while($row = mysqli_fetch_array($query)) {
                                                        echo '<option value="'.$row['strand_id'].'">'.$row['strand_name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-3 mt-3 justify-content-cente">   
                                        <div class="input-group col-md-6 mb-2 ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-sm"><b>
                                                        LRN</b></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 11-digit lrn"
                                                name="lrn">
                                        </div>
                                    </div>
                                </div>
                                
                            <div class="bg-purple">
                                    <div class="card-header text-center">
                                        <h3 class="text-lg" style="margin-bottom: unset;">
                                            PERSONAL DATA
                                        </h3>
                                    </div>
                                </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            

                                <!-- PERSONAL DATA -->

                                <div class="card-body">

                                    <div class="form-group row mb-3 mt-3">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Lastname</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Lastname"
                                              name="lastname">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Firstname</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Firstname"
                                               name="firstname">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Middlename</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Middlename"
                                              name="midname">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="address"
                                              
                                                placeholder="Unit number, house number, street name, barangay, city, province">
                                        </div>


                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Date of Birth</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="date_birth"
                                                placeholder="dd/mm/yyyy">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Place of Birth</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="place_birth"
                                                placeholder="city, province">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Age</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="age"
                                           placeholder="00 years old">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Gender</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Gender" name="gender">
                                                <option selected disabled></option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tbl_genders");
                                                    while($row = mysqli_fetch_array($query)) {
                                                        echo '<option value="'.$row['gender_id'].'">'.$row['gender_name'].'</option>';
                                                    }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Nationality</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nationality"
                                              name="nationality">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Religion</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Religion"
                                             name="religion">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Landline No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Landline Number"
                                               name="landline">
                                        </div>

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Cell Phone No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Cellphone Number"
                                              name="cellphone">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Email Address</b></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="example@gmail.com"
                                              name="email">
                                        </div>
                                    </div>
                                </div>

                                <!-- FAMILYBACKGROUND -->

                                <div class="bg-purple">
                                    <div class="card-header text-center">
                                        <h3 class="text-lg" style="margin-bottom: unset;">
                                            FAMILY BACKGROUND
                                        </h3>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group row mb-3 mt-3">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Name of Father</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Fullname"
                                                name="fname">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        F. Occupation</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Father Occupation"
                                              name="focc">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Contact No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                              name="fcontact">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Name of Mother</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Fullname"
                                             name="mname">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        M. Occupation</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Father Occupation"
                                             name="mocc">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Contact No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                             name="mcontact">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">


                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Monthly Income</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Family Income"
                                             name="month_inc">
                                        </div>

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        No. of Siblings</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Number of Siblings"
                                             name="no_sib">
                                        </div>

                                    </div>


                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Guardian N.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Guardian Name"
                                              name="guardname">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">


                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="gaddress"
                                               
                                                placeholder="Unit number, house number, street name, barangay, city, province">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">


                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Contact No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="gcontact"
                                                 placeholder="Contact Number">
                                        </div>

                                    </div>


                                </div>


                                <!-- EDUCATIONAL BACKGROUND -->

                                <div class="bg-purple">
                                    <div class="card-header text-center">
                                        <h3 class="text-lg" style="margin-bottom: unset;">
                                            EDUCATIONAL BACKGROUND
                                        </h3>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group row mb-3 mt-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        SCH. Last Attended</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="School Last Attended"
                                                name="last_attend">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">



                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Grade Level</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Grade Level" name="prev_grade_level">
                                                <?php
                                                $get = mysqli_query($conn, "SELECT * FROM tbl_grade_levels");
                                                    while ($row2 = mysqli_fetch_array($get)) {
                                                            echo '<option value="' . $row2['grade_level'] . '">'
                                                                . $row2['grade_level'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        School Year</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="year-year"
                                                name="sch_year">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        School Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="School Address"
                                                name="sch_address">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                                        <label class="custom-control-label" for="exampleCheck1">I agree that the data collected from this online registration shall be subject to the school's <a href="terms/SFAC-Data-Privacy.pdf">Data Privacy Policy</a>.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn bg-purple"><i
                                            class="fa fa-user-check"></i>
                                        Register</button>
                                </div>
                            </form>

                            <!-- /.card -->

                        </div><!-- /.container-fluid -->
                    </div>
                </section>

                    <!-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                    <!-- /.social-auth-links -->


                    <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- Validation toast -->
    <?php
    if (isset($_SESSION['pwd-error'])) {
        echo "<script>
    $(function() {
        toastr.error('The password you’ve entered is incorrect.')
    });
    </script>";
    } elseif (isset($_SESSION['no-input'])) {
        echo "<script>
            $(function () {
                toastr.error('Enter your valid username and password.')
            });
        </script>";
    }
    session_destroy();
    ?>
    <!-- End Validation toast -->


</body>

</html>