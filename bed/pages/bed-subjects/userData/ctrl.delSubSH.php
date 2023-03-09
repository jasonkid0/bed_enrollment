<?php
require '../../../includes/conn.php';
session_start();

$sub_id = $_GET['sub_id'];

mysqli_query($conn, "DELETE FROM tbl_subjects_senior WHERE subject_id='$sub_id'") or die(mysqli_error($conn));
$_SESSION['success-del'] = true;
header('location: ../list.subjectSH.php');