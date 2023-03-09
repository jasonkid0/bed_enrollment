<?php

if (!empty($_SESSION['role'])) {
    if ($_SESSION['role'] == "Master Key") {
        $mk_id = $_SESSION['mk_id'];
        if ($mk_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Registrar") {
        $reg_id = $_SESSION['reg_id'];
        if ($reg_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Principal") {
        $prin_id = $_SESSION['prin_id'];
        if ($prin_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Accounting") {
        $acc_id = $_SESSION['acc_id'];
        if ($acc_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Admission") {
        $admission_id = $_SESSION['admission_id'];
        if ($admission_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Teacher") {
        $teacher_id = $_SESSION['teacher_id'];
        if ($teacher_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Adviser") {
        $ad_id = $_SESSION['ad_id'];
        if ($ad_id == false) {
            header("location: ../bed-login/login.php");
        }
    } elseif ($_SESSION['role'] == "Student") {
        $stud_id = $_SESSION['stud_id'];
        if ($stud_id == false) {
            header("location: ../bed-login/login.php");
        }
    } else {
        header("location: ../bed-login/login.php");
    }
} else {
    header("location: ../bed-login/login.php");
}