<?php
require '../../../includes/conn.php';
session_start();

$stud_id = $_SESSION['stud_id'];

if (isset($_POST['upload'])) {

    if (empty($_FILES['image']['tmp_name'])) {
        $_SESSION['no-img'] = true;
        header('location: ../edit.student.php');
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $set_userInfo = mysqli_query($conn, "UPDATE tbl_students SET img = '$image' WHERE student_id = '$stud_id'") or die(mysqli_error($conn));
        $_SESSION['success-studEdit'] = true;
        header('location: ../edit.student.php');
    }
} elseif (isset($_POST['submit'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $midname = mysqli_real_escape_string($conn, $_POST['midname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    if (empty($password) && empty($password2)) {
        $_SESSION['no-pwd'] = true;
        header('location: ../edit.student.php');
    } else {
        if ($password != $password2) {
            $_SESSION['error-pass'] = true;
            header('location: ../edit.student.php');
        } else {
            $hashpwd = password_hash($password, PASSWORD_BCRYPT);
            $insertUser = mysqli_query($conn, "UPDATE tbl_students SET student_fname = '$firstname', student_lname = '$lastname', student_mname = '$midname', email = '$email', username = '$username', password = '$hashpwd' WHERE student_id = '$stud_id'") or die(mysqli_error($conn));
            $_SESSION['success-studEdit'] = true;
            header('location: ../edit.student.php');
        }
    }
}