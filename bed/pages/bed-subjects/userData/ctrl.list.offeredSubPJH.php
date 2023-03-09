<?php
require '../../../includes/conn.php';
session_start();

$stud_id = $_GET['stud_id'];

if (isset($_POST['submit'])) {


    if (empty($_POST['checked'])) {
        $_SESSION['empty-check'] = true;
        if ($_SESSION['role'] == "Student") {
            header('location: ../list.offeredSubPJH.php');
        } elseif ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") {
            header('location: ../list.offeredSubPJH.php?stud_id=' . $stud_id);
        }
    } else {
        foreach ($_POST['checked'] as $index) {
            $sched_id = $_POST['sched_id'];
            $studID = $_POST['studID'];
            $insert = mysqli_query($conn, "INSERT INTO tbl_enrolled_subjects (schedule_id, student_id) VALUES ('$sched_id[$index]', '$studID[$index]')") or die(mysqli_error($conn));
            $_SESSION['success'] = true;
            if ($_SESSION['role'] == "Student") {
                header('location: ../list.enrolledSubPJH.php');
            } elseif ($_SESSION['role'] == "Admission" || $_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar" || $_SESSION['role'] == "Adviser") {
                header('location: ../list.enrolledSubPJH.php?stud_id=' . $stud_id);
            }
        }
    }
}