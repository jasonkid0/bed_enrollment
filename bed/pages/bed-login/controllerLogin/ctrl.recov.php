<?php
require '../../../includes/conn.php';
session_start();
ob_start();

$email = $_SESSION['email'];
$code = $_SESSION['code'];
if (isset($_POST['submit'])) {


    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);


    if ($password != $password2) {
        $_SESSION['error-pass'] = true;
        header("location: ../recov.pwd.php");
    } else {
        $hashpwd = password_hash($password, PASSWORD_BCRYPT);
        $setPWD = mysqli_query($conn, "UPDATE tbl_master_key SET password = '$hashpwd' WHERE email = '$email'");
        $_SESSION['pre-loader'] = true;
        $_SESSION['role'] = "Master Key";
        $_SESSION['mk_id'] = $row['mk_id'];
        header("location: ../../bed-dashboard/index.php");
    }
}