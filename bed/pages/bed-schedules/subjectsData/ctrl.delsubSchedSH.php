<?php
require '../../../includes/conn.php';
session_start();

$sched_id = $_GET['sched_id'];
$str_n = $_GET['str_n'];

mysqli_query($conn, "DELETE FROM tbl_schedules WHERE schedule_id = '$sched_id'") or die(mysqli_error($conn));
$_SESSION['success-del'] = true;
if ($str_n == "ABM") {
    header('location: ../list.subSchedSH.php?abm=' . $str_n);
} else if ($str_n == "STEM") {
    header('location: ../list.subSchedSH.php?stem=' . $str_n);
} else if ($str_n == "GAS") {
    header('location: ../list.subSchedSH.php?gas=' . $str_n);
} else if ($str_n == "HUMSS") {
    header('location: ../list.subSchedSH.php?humss=' . $str_n);
} else if ($str_n == "TVL - HE") {
    header('location: ../list.subSchedSH.php?tvl=' . $str_n);
}