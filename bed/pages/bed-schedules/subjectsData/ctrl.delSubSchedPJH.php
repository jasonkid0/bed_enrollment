<?php
require '../../../includes/conn.php';
session_start();

$sched_id = $_GET['sched_id'];
$grd_lvl = $_GET['grd_lvl'];

mysqli_query($conn, "DELETE FROM tbl_schedules WHERE schedule_id = '$sched_id'") or die(mysqli_error($conn));
$_SESSION['success-del'] = true;
if ($grd_lvl == "Grade 1") {
    header('location: ../list.subSchedPJH.php?g1=' . $grd_lvl);
} else if ($grd_lvl == "Grade 2") {
    header('location: ../list.subSchedPJH.php?g2=' . $grd_lvl);
} else if ($grd_lvl == "Grade 3") {
    header('location: ../list.subSchedPJH.php?g3=' . $grd_lvl);
} else if ($grd_lvl == "Grade 4") {
    header('location: ../list.subSchedPJH.php?g4=' . $grd_lvl);
} else if ($grd_lvl == "Grade 5") {
    header('location: ../list.subSchedPJH.php?g5=' . $grd_lvl);
} else if ($grd_lvl == "Grade 6") {
    header('location: ../list.subSchedPJH.php?g6=' . $grd_lvl);
} else if ($grd_lvl == "Grade 7") {
    header('location: ../list.subSchedPJH.php?g7=' . $grd_lvl);
} else if ($grd_lvl == "Grade 8") {
    header('location: ../list.subSchedPJH.php?g8=' . $grd_lvl);
} else if ($grd_lvl == "Grade 9") {
    header('location: ../list.subSchedPJH.php?g9=' . $grd_lvl);
} else if ($grd_lvl == "Grade 10") {
    header('location: ../list.subSchedPJH.php?g10=' . $grd_lvl);
} else if ($grd_lvl == "Nursery") {
    header('location: ../list.subSchedPJH.php?nurs=' . $grd_lvl);
} else if ($grd_lvl == "Pre-Kinder") {
    header('location: ../list.subSchedPJH.php?pkdr=' . $grd_lvl);
} else if ($grd_lvl == "Kinder") {
    header('location: ../list.subSchedPJH.php?kdr=' . $grd_lvl);
}