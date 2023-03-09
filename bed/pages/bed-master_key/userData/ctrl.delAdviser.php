<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['ad_id'];

mysqli_query($conn, "DELETE FROM tbl_adviser WHERE ad_id = '$get_userID'");
$_SESSION['success-del'] = true;
header('location: ../list.adviser.php');