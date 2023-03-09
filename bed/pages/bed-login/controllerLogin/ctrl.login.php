<?php
require '../../../includes/conn.php';
ob_start();
session_start();

// Submit button <-- login.php 
if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    // Username Verify
    $master_key = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE username = '$username'");
    $numrow_mk = mysqli_num_rows($master_key);

    $registrar = mysqli_query($conn, "SELECT * FROM tbl_registrars WHERE username = '$username'");
    $numrow_reg = mysqli_num_rows($registrar);

    $principal = mysqli_query($conn, "SELECT * FROM tbl_principals WHERE username = '$username'");
    $numrow_prin = mysqli_num_rows($principal);

    $accounting = mysqli_query($conn, "SELECT * FROM tbl_accountings WHERE username = '$username'");
    $numrow_acc = mysqli_num_rows($accounting);

    $admission = mysqli_query($conn, "SELECT * FROM tbl_admissions WHERE username = '$username'");
    $numrow_admission = mysqli_num_rows($admission);

    $teacher = mysqli_query($conn, "SELECT * FROM tbl_teachers WHERE username = '$username'");
    $numrow_teacher = mysqli_num_rows($teacher);

    $adviser = mysqli_query($conn, "SELECT * FROM tbl_adviser WHERE username = '$username'");
    $numrow_adviser = mysqli_num_rows($adviser);

    $student = mysqli_query($conn, "SELECT * FROM tbl_students WHERE username = '$username'");
    $numrow_student = mysqli_num_rows($student);




    //End Username Verify

    //password verify
    if ($numrow_mk > 0) {
        while ($row = mysqli_fetch_array($master_key)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header("location: ../login.php");
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Master Key";
                $_SESSION['mk_id'] = $row['mk_id'];
                header("Location: ../../../pages/bed-dashboard/index.php");
            }
        }
    } elseif ($numrow_reg > 0) {
        while ($row = mysqli_fetch_array($registrar)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Registrar";
                $_SESSION['reg_id'] = $row['reg_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_prin > 0) {
        while ($row = mysqli_fetch_array($principal)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Principal";
                $_SESSION['prin_id'] = $row['prin_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_acc > 0) {
        while ($row = mysqli_fetch_array($accounting)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Accounting";
                $_SESSION['acc_id'] = $row['acc_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_admission > 0) {
        while ($row = mysqli_fetch_array($admission)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Admission";
                $_SESSION['admission_id'] = $row['admission_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_teacher > 0) {
        while ($row = mysqli_fetch_array($teacher)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Teacher";
                $_SESSION['teacher_id'] = $row['teacher_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_adviser > 0) {
        while ($row = mysqli_fetch_array($adviser)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Adviser";
                $_SESSION['ad_id'] = $row['ad_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } elseif ($numrow_student > 0) {
        while ($row = mysqli_fetch_array($student)) {
            $checkPWDhash = password_verify($password, $row['password']);
            if ($checkPWDhash == false) {
                $_SESSION['pwd-error'] = true;
                header('location: ../login.php');
            } elseif ($checkPWDhash == true) {
                $_SESSION['pre-loader'] = true;
                $_SESSION['role'] = "Student";
                $_SESSION['stud_id'] = $row['student_id'];
                header('location: ../../../pages/bed-dashboard/index.php');
            }
        }
    } else {
        $_SESSION['no-input'] = true;
        header("location: ../login.php");
    }
}
// End password verify