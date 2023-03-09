<?php
require '../../includes/conn.php';
session_start();
ob_start();

require '../../includes/bed-session.php';

$or_id = $_GET['or_id'];
$_SESSION['or_id'] = $or_id;

?>

<!DOCTYPE html>
<html lang="en">

<!-- Head and links -->

<head>
    <title>SFAC | Personal Info </title>
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
                    <a href="#" class="nav-link disabled text-light">Personal Info.</a>
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
                            <div class="card-header text-center">
                                <h3 class="text-lg" style="margin-bottom: unset;">
                                    REGISTRATION FORM
                                </h3>
                            </div>
                            <form action="userData/ctrl.admitonline.php" enctype="multipart/form-data" method="POST">
                            <?php
                                $display_info = mysqli_query($conn, "SELECT *, CONCAT(tbl_online_reg.student_lname, ', ', tbl_online_reg.student_fname, ' ', tbl_online_reg.student_mname) AS fullname FROM tbl_online_reg
                                    LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_online_reg.gender_id
                                    LEFT JOIN tbl_grade_levels ON tbl_grade_levels.grade_level_id = tbl_online_reg.grade_level_id
                                    WHERE or_id = '".$_GET['or_id']."'") or die (mysqli_error($conn));

                                while ($row = mysqli_fetch_array($display_info)) {
                            ?>
                                <div class="card-body">
                                    <div class="row mb-4 mt-4 justify-content-center">
                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Student Type</b></span>
                                            </div>
                                            <select class="form-control custom-select select2 select2-purple"
                                                data-dropdown-css-class="select2-purple"
                                                data-placeholder="Select Student Type" name="studtype">
                                                <option value="<?php echo $row['stud_type']; ?>"><?php echo $row['stud_type']; ?></option>
                                                <option value="New">New</option>
                                                <option value="Old">Old</option>
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
                                                <?php if (empty($row['grade_level_id'])) {
                                                            echo '<option value="" disabled selected>Select Gender</option>';
                                                            $get_level = mysqli_query($conn, "SELECT * FROM tbl_grade_levels");
                                                            while ($row2 = mysqli_fetch_array($get_level)) {
                                                                echo '
                                                <option value="' . $row2['grade_level_id'] .
                                                                    '">' . $row2['grade_level'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>Select Gender</option>
                                                        <option value="' . $row['grade_level_id'] .
                                                                '" selected >' . $row['grade_level'] . '</option>';
                                                            $get_level = mysqli_query($conn, "SELECT * FROM tbl_grade_levels WHERE grade_level_id NOT IN (" . $row['grade_level_id'] . ")");
                                                            while ($row3 = mysqli_fetch_array($get_level)) {
                                                                echo '<option value="' . $row3['grade_level_id'] . '">'
                                                                    . $row3['grade_level'] . '</option>';
                                                            }
                                                        } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mt-3 justify-content-center">   
                                        <div class="input-group col-md-6 mb-2 ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-sm"><b>
                                                        LRN</b></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 11-digit lrn"wwww
                                               value="<?php echo $row['lrn']; ?>" name="lrn">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Student No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Enter Student Number"
                                              name="stud_no">
                                        </div>
                                    </div>
                                </div>
                            <div class="bg-purple">
                                    <div class="card-header text-center">
                                        <h3 class="text-lg" style="margin-bottom: unset;">
                                            ACCOUNT DETAILS
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-3 mt-3">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Password"
                                             name="password">
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
                                             value="<?php echo $row['student_lname']; ?>" name="lastname">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Firstname</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Firstname"
                                             value="<?php echo $row['student_fname']; ?>"  name="firstname">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Middlename</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Middlename"
                                             value="<?php echo $row['student_mname']; ?>" name="midname">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="address" placeholder="Unit number, house number, street name, barangay, city, province" value="<?php echo $row['address']; ?>">
                                        </div>


                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Date of Birth</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="date_birth"
                                                value="<?php echo $row['date_birth']; ?>" placeholder="dd/mm/yyyy">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Place of Birth</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="place_birth"
                                              value="<?php echo $row['place_birth']; ?>"  placeholder="city, province">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Age</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="age"
                                           value="<?php echo $row['age']; ?>" placeholder="00 years old">
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
                                                        <?php if (empty($row['gender_id'])) {
                                                            echo '<option value="" disabled selected>Select Gender</option>';
                                                            $get_gender = mysqli_query($conn, "SELECT * FROM tbl_genders");
                                                            while ($row2 = mysqli_fetch_array($get_gender)) {
                                                                echo '
                                                <option value="' . $row2['gender_id'] .
                                                                    '">' . $row2['gender_name'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>Select Gender</option>
                                                        <option value="' . $row['gender_id'] .
                                                                '" selected >' . $row['gender_name'] . '</option>';
                                                            $get_gender = mysqli_query($conn, "SELECT * FROM tbl_genders WHERE gender_id NOT IN (" . $row['gender_id'] . ")");
                                                            while ($row3 = mysqli_fetch_array($get_gender)) {
                                                                echo '<option value="' . $row3['gender_id'] . '">'
                                                                    . $row3['gender_name'] . '</option>';
                                                            }
                                                        } ?>
                                            </select>

                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Nationality</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nationality"  value="<?php echo $row['nationality']; ?>" name="nationality">
                                        </div>

                                        <div class="input-group col-md-4 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Religion</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Religion"
                                             value="<?php echo $row['religion']; ?>" name="religion">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Landline No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Landline Number"
                                              value="<?php echo $row['landline']; ?>" name="landline">
                                        </div>

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Cell Phone No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Cellphone Number"
                                             value="<?php echo $row['cellphone']; ?>" name="cellphone">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Email Address</b></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="example@gmail.com"
                                             value="<?php echo $row['email']; ?>" name="email">
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
                                               value="<?php echo $row['fname']; ?>"  name="fname">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        F. Occupation</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Father Occupation"
                                             value="<?php echo $row['focc']; ?>" name="focc">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Contact No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                             value="<?php echo $row['fcontact']; ?>" name="fcontact">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Name of Mother</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Fullname"
                                             value="<?php echo $row['mname']; ?>" name="mname">
                                        </div>

                                        <div class="input-group col-md-6 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        M. Occupation</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Father Occupation"
                                            value="<?php echo $row['mocc']; ?>" name="mocc">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Contact No.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                             value="<?php echo $row['mcontact']; ?>" name="mcontact">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">


                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Monthly Income</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Family Income"
                                             value="<?php echo $row['month_inc']; ?>" name="month_inc">
                                        </div>

                                        <div class="input-group col-md-4 mb-2 ml-auto mr-auto">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        No. of Siblings</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Number of Siblings"
                                             value="<?php echo $row['no_siblings']; ?>" name="no_sib">
                                        </div>

                                    </div>


                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Guardian N.</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Guardian Name"
                                             value="<?php echo $row['guardname']; ?>" name="guardname">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">


                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" name="gaddress"
                                               value="<?php echo $row['gaddress']; ?>" 
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
                                            value="<?php echo $row['gcontact']; ?>"
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
                                            value="<?php echo $row['last_sch']; ?>"
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
                                                <?php if (empty($row['prev_grade_level'])) {
                                                            echo '<option value="None" selected>Select Grade Level</option>';
                                                            $get_glevel = mysqli_query($conn, "SELECT * FROM tbl_grade_levels");
                                                            while ($row2 = mysqli_fetch_array($get_glevel)) {
                                                                echo '<option value="' . $row2['grade_level'] . '">'
                                                                    . $row2['grade_level'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>Select Grade Level</option>
                                                        <option value="' . $row['prev_grade_level'] . '" selected>'
                                                                . $row['prev_grade_level'] . '</option>';
                                                            $get_glevel = mysqli_query($conn, "SELECT * FROM tbl_grade_levels WHERE grade_level NOT IN ('" . $row['prev_grade_level'] . "') ");
                                                            while ($row3 = mysqli_fetch_array($get_glevel)) {
                                                                echo '<option value="' . $row3['grade_level'] . '">'
                                                                    . $row3['grade_level'] . '</option>';
                                                            }
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
                                                name="sch_year" value="<?php echo $row['sch_year']; ?>">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-3">

                                        <div class="input-group col-md-12 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm"><b>
                                                        School Address</b></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="School Address"
                                                name="sch_address" value="<?php echo $row['sch_address']; ?>">
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
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
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <!-- Footer and script -->
            <?php include '../../includes/bed-footer.php';

            // alert 
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
            unset($_SESSION['no-img']); ?>

</body>

</html>