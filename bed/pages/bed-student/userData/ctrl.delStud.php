<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['student_id'];

mysqli_query($conn, "DELETE FROM tbl_students WHERE student_id = '$get_userID'") or die(mysqli_error($conn));
$_SESSION['success-del'] = true;
if ($_SESSION['role'] == "Admission") {
    header('location: ../list.student.php?search=' . $_SESSION['search'] . '&look=');
} else {
    header('location: ../list.student.php');
}