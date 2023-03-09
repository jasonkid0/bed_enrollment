<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['reg_id'];

mysqli_query($conn, "DELETE FROM tbl_registrars WHERE reg_id = '$get_userID'") or die(mysqli_error($conn));
$_SESSION['success-del'] = true;
header('location: ../list.registrar.php');