<?php
require '../../../includes/conn.php';
session_start();

if (isset($_POST['submit'])) {

    $actacadyear = mysqli_real_escape_string($conn, $_POST['act_acadyear']);

    $update = mysqli_query($conn, "UPDATE tbl_active_acadyears SET ay_id = '$actacadyear'") or die(mysqli_error($conn));
    $_SESSION['success'] = true;
    header('location: ../set.date.php');
}


if (isset($_POST['submit1'])) {

    $actsem = mysqli_real_escape_string($conn, $_POST['act_sem']);

    $update = mysqli_query($conn, "UPDATE tbl_active_semesters SET semester_id = '$actsem'") or die(mysqli_error($conn));
    $_SESSION['success'] = true;
    header('location: ../set.date.php');
}