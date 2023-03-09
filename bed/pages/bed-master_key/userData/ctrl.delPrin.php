<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['prin_id'];

mysqli_query($conn, "DELETE FROM tbl_principals WHERE prin_id = '$get_userID'");
$_SESSION['success-del'] = true;
header('location: ../list.principal.php');