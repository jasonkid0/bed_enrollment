<?php
require '../../../includes/conn.php';
session_start();


if (isset($_POST['submit'])) {


    $acadyear = $_POST['acadyear'];
    $sem = $_POST['sem'];
    $sub_id = $_POST['sub'];
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $teach = mysqli_real_escape_string($conn, $_POST['instruct']);

    $check = mysqli_query($conn, "SELECT * FROM tbl_schedules WHERE subject_id = '$sub_id' AND teacher_id = '$teach' AND day = '$days' AND time = '$time' AND room = '$room' AND semester = '$sem' AND acadyear = '$acadyear'") or die(mysqli_error($conn));
    $result = mysqli_num_rows($check);

    if ($result > 0) {
        $_SESSION['dbl-sched'] = true;
        header('location: ../add.petitionedSH.php?str=' . $_SESSION['strand_n'] . '&eay=' . $_SESSION['eay']);
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_schedules (subject_id, teacher_id, day, time, room, semester, acadyear) VALUES ('$sub_id', '$teach', '$days', '$time', '$room', '$sem', '$acadyear')") or die(mysqli_error($conn));
        $_SESSION['success'] = true;
        header('location: ../add.petitionedSH.php?str=' . $_SESSION['strand_n'] . '&eay=' . $_SESSION['eay']);
    }
}