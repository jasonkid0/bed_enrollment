<?php
require '../../../includes/conn.php';
session_start();




if (isset($_POST['submit'])) {

    $acadyear = $_POST['acad'];
    $glvl = mysqli_real_escape_string($conn, $_POST['glvl']);
    $sub_id = mysqli_real_escape_string($conn, $_POST['sub_id']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $instruct = mysqli_real_escape_string($conn, $_POST['instruct']);

    $check_double = mysqli_query($conn, "SELECT * FROM tbl_schedules WHERE subject_id = '$sub_id' AND teacher_id = '$instruct' AND day = '$days' AND time = '$time' AND room = '$room' AND semester = '0' AND acadyear = '$acadyear' AND grade_level_id = $glvl") or die(mysqli_error($conn));
    $result = mysqli_num_rows($check_double);

    if ($result > 0) {
        $_SESSION['dbl-sched'] = true;
        header('location: ../add.subSchedPJH.php?sub_id=' . $_SESSION['sub_id']);
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_schedules (subject_id, teacher_id, day, time, room, semester, acadyear, grade_level_id) VALUES ('$sub_id', '$instruct', '$days', '$time', '$room', '0', '$acadyear', '$glvl')") or die(mysqli_error($conn));
        $_SESSION['success'] = true;
        header('location: ../add.subSchedPJH.php?sub_id=' . $_SESSION['sub_id']);
    }
}