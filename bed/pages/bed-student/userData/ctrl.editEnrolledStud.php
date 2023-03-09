<?php require '../../../includes/conn.php';
session_start();


if (isset($_POST['sub_remark'])) {

    $sy_id = $_GET['id'];

    $sel_remark = mysqli_query($conn, "SELECT remark FROM tbl_schoolyears WHERE sy_id = '$sy_id'") or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($sel_remark)) {
        if ($_SESSION['role'] == "Accounting" || $_SESSION['role'] == "Registrar") {
            if ($row['remark'] == 'Confirmed' || $row['remark'] == 'Disapproved') {
                $remark = 'Approved';
                $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET remark = '$remark' WHERE sy_id = '$sy_id'") or die(mysqli_error($conn));
                $_SESSION['approve'] = true;
                header('location: ../list.enrolledStud.php?search=' . $_SESSION['search'] . '&look=');
            } else {
                $remark = 'Disapproved';
                $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET remark = '$remark' WHERE sy_id = '$sy_id'") or die(mysqli_error($conn));
                $_SESSION['disapprove'] = true;
                header('location: ../list.enrolledStud.php?search=' . $_SESSION['search'] . '&look=');
            }
        } else {
            if ($row['remark'] == 'Confirmed' || $row['remark'] == 'Disapproved') {
                $remark = 'Canceled';
                $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET remark = '$remark' WHERE sy_id = '$sy_id'") or die(mysqli_error($conn));
                $_SESSION['cancel'] = true;
                header('location: ../list.enrolledStud.php');
            } else {
                $remark = 'Confirmed';
                $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET remark = '$remark' WHERE sy_id = '$sy_id'") or die(mysqli_error($conn));
                $_SESSION['confirm'] = true;
                header('location: ../list.enrolledStud.php');
            }
        }
    }
}

if (isset($_POST['submit'])) {

    $acadyear = mysqli_real_escape_string($conn, $_POST['acadyear']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);
    $strand_id = mysqli_real_escape_string($conn, $_POST['strand']);
    $stud_type = mysqli_real_escape_string($conn, $_POST['stud_type']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);


    if ($grade_level > 13) {
        if (empty($strand_id)) {
            $_SESSION['field_required'] = true;
            header('location: ../edit.enrolledStud.php?stud_id=' . $_SESSION['student_id']);
        } else {
            $double_stud = mysqli_query($conn, "SELECT * FROM tbl_schoolyears WHERE ay_id = '$acadyear' AND semester_id = '$sem' AND student_id = '$stud_id' AND  grade_level_id = '$grade_level' AND strand_id = '$strand_id' AND stud_type = '$stud_type' AND section = '$section'") or die(mysqli_error($conn));
            $result = mysqli_num_rows($double_stud);

            if ($result > 0) {
                $_SESSION['update-success'] = true;
                header('location: ../edit.enrolledStud.php?stud_id=' . $_SESSION['student_id']);
            } else {
                $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET grade_level_id = '$grade_level', strand_id = '$strand_id', stud_type = '$stud_type', section = '$section', semester_id = '$sem' WHERE ay_id = '$acadyear' AND (semester_id = '$sem' OR semester_id = '0') AND student_id = '$stud_id'") or die(mysqli_error($conn));
                $_SESSION['update-success'] = true;
                header('location: ../edit.enrolledStud.php?stud_id=' . $_SESSION['student_id']);
            }
        }
    } else if ($grade_level < 14) {
        $double_stud = mysqli_query($conn, "SELECT * FROM tbl_schoolyears WHERE ay_id = '$acadyear' AND student_id = '$stud_id' AND  grade_level_id = '$grade_level' AND stud_type = '$stud_type' AND section = '$section'") or die(mysqli_error($conn));
        $result = mysqli_num_rows($double_stud);

        if ($result > 0) {
            $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET strand_id = '', semester_id = '' WHERE student_id = $stud_id AND ay_id = '$acadyear'") or die(mysqli_error($conn));
            $_SESSION['update-success'] = true;
            header('location: ../edit.enrolledStud.php?stud_id=' . $_SESSION['student_id']);
        } else {
            $update = mysqli_query($conn, "UPDATE tbl_schoolyears SET grade_level_id = '$grade_level', stud_type = '$stud_type', strand_id = '', section = '$section', semester_id = '' WHERE student_id = $stud_id AND ay_id = '$acadyear' AND (semester_id = '$sem' OR semester_id = '0')") or die(mysqli_error($conn));
            $_SESSION['update-success'] = true;
            header('location: ../edit.enrolledStud.php?stud_id=' . $_SESSION['student_id']);
        }
    }
}