<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['teacher_id'];

mysqli_query($conn, "DELETE FROM tbl_teachers WHERE teacher_id = '$get_userID'");
$_SESSION['success-del'] = true;
header('location: ../list.teacher.php');