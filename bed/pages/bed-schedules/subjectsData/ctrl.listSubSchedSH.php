<?php
require '../../../includes/conn.php';
session_start();




if (isset($_POST['submit'])) {

    $acadyear = mysqli_real_escape_string($conn, $_POST['acadyear']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);
    $sub_id = mysqli_real_escape_string($conn, $_POST['sub_id']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $instruct = mysqli_real_escape_string($conn, $_POST['instruct']);

    $check_double = mysqli_query($conn, "SELECT * FROM tbl_schedules WHERE subject_id = '$sub_id' AND teacher_id = '$instruct' AND day = '$days' AND time = '$time' AND room = '$room' AND semester = '$sem' AND acadyear = '$acadyear'") or die(mysqli_error($conn));
    $result = mysqli_num_rows($check_double);

    if ($result > 0) {
        $_SESSION['dbl-sched'] = true;
        header('location: ../edit.subSchedSH.php?sub_id=' . $_SESSION['sub_id'] . '&sched_id=' . $_SESSION['sched_id']);
    } else {
        $insert = mysqli_query($conn, "UPDATE tbl_schedules SET day = '$days', time = '$time', room = '$room', teacher_id = '$instruct' WHERE subject_id = '$sub_id' AND acadyear = '$acadyear' AND semester = '$sem' AND schedule_id = '$_SESSION[sched_id]'") or die(mysqli_error($conn));
        $_SESSION['update-success'] = true;
        header('location: ../edit.subSchedSH.php?sub_id=' . $_SESSION['sub_id'] . '&sched_id=' . $_SESSION['sched_id']);
    }
}