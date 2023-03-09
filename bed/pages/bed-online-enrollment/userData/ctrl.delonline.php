<?php require '../../../includes/conn.php';
session_start();

$get_userID = $_GET['or_id'];
mysqli_query($conn, "DELETE FROM tbl_online_reg WHERE or_id = '$get_userID'");
$_SESSION['success-del'] = true;
header('location: ../online_list.php');

?>