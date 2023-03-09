<?php require '../../../includes/conn.php';
session_start();

if (isset($_POST['submit'])) {

    $acadyear = mysqli_real_escape_string($conn, $_POST['acadyear']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);
    $strand_id = mysqli_real_escape_string($conn, $_POST['strand']);
    $date_enrolled = date('d-M-y');
    $stud_type = mysqli_real_escape_string($conn, $_POST['stud_type']);
    $remark = mysqli_real_escape_string($conn, $_POST['remark']);


    if ($grade_level == '14' || $grade_level == '15') {
        if (empty($strand_id)) {
            $_SESSION['field_required'] = true;
            header('location: ../add.enroll.php');
        } else {
            $double_stud = mysqli_query($conn, "SELECT * FROM tbl_schoolyears WHERE ay_id = '$acadyear' AND semester_id = '$sem' AND student_id = '$stud_id' AND  grade_level_id = '$grade_level' AND strand_id = '$strand_id'") or die(mysqli_error($conn));
            $result = mysqli_num_rows($double_stud);

            if ($result > 0) {
                $_SESSION['dbl-stud'] = true;
                header('location: ../add.enroll.php');
            } else {
                $insert = mysqli_query($conn, "INSERT INTO tbl_schoolyears (ay_id, semester_id, student_id, grade_level_id, strand_id, date_enrolled, stud_type, remark) VALUES ('$acadyear', '$sem', '$stud_id', '$grade_level', '$strand_id', '$date_enrolled', '$stud_type', '$remark')") or die(mysqli_error($conn));
                $_SESSION['submit-success'] = true;
                header('location: ../../bed-subjects/list.enrolledSubSH.php');
            }
        }
    } else {
        $double_stud = mysqli_query($conn, "SELECT * FROM tbl_schoolyears WHERE ay_id = '$acadyear' AND student_id = '$stud_id' AND  grade_level_id = '$grade_level'") or die(mysqli_error($conn));
        $result = mysqli_num_rows($double_stud);

        if ($result > 0) {
            $_SESSION['dbl-stud'] = true;
            header('location: ../add.enroll.php');
        } else {
            $insert = mysqli_query($conn, "INSERT INTO tbl_schoolyears (ay_id, student_id, grade_level_id, date_enrolled, stud_type, remark) VALUES ('$acadyear', '$stud_id', '$grade_level', '$date_enrolled', '$stud_type', '$remark')") or die(mysqli_error($conn));
            $_SESSION['submit-success'] = true;
            header('location: ../../bed-subjects/list.enrolledSubSH.php');
        }
    }
}