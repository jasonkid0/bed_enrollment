<?php
require '../../../includes/conn.php';
session_start();

if (isset($_POST['submit'])) {

    $eay = mysqli_real_escape_string($conn, $_POST['eay']);

    $check_double = mysqli_query($conn, "SELECT * FROM tbl_efacadyears WHERE efacadyear = '$eay'") or die(mysqli_error($conn));
    $result = mysqli_num_rows($check_double);

    if ($result > 0) {
        $_SESSION['year-exists'] = true;
        header('location: ../add.date.php');
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_efacadyears (efacadyear) VALUES ('$eay')") or die(mysqli_error($conn));
        $_SESSION['success'] = true;
        header('location: ../add.date.php');
    }
}

if (isset($_POST['submit1'])) {

    $acadyear = mysqli_real_escape_string($conn, $_POST['acadyear']);

    $check_double = mysqli_query($conn, "SELECT * FROM tbl_acadyears WHERE academic_year = '$acadyear'") or die(mysqli_error($conn));
    $result = mysqli_num_rows($check_double);

    if ($result > 0) {
        $_SESSION['acyear-exists'] = true;
        header('location: ../add.date.php');
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_acadyears (academic_year) VALUES ('$acadyear')") or die(mysqli_error($conn));
        $_SESSION['success'] = true;
        header('location: ../add.date.php');
    }
}