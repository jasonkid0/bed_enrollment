<?php
require '../../../includes/conn.php';
session_start();
ob_start();


if (isset($_POST['submit'])) {

    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $checkCode = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE activation_code = '$code' AND email = '$email'");
    if (mysqli_num_rows($checkCode) > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['code'] = $code;
        header("location: ../recov.pwd.php");
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['error_code'] = true;
        header("location: ../code.ver.php");
    }
}