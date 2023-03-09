<?php
require '../../../includes/conn.php';
session_start();

$mk_id = $_SESSION['mk_id'];

if (isset($_POST['upload'])) {

    if (empty($_FILES['image']['tmp_name'])) {
        $_SESSION['no-img'] = true;
        header('location: ../edit.master.php?mk_id=' . $mk_id);
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $set_userInfo = mysqli_query($conn, "UPDATE tbl_master_key SET img = '$image' WHERE mk_id = '$mk_id'") or die(mysqli_error($conn));
        $_SESSION['success-regEdit'] = true;
        header('location: ../edit.master.php?mk_id=' . $mk_id);
    }
} elseif (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    if (empty($password) && empty($password2)) {
        $_SESSION['no-pwd'] = true;
        header('location: ../edit.master.php?mk_id=' . $mk_id);
    } else {
        if ($password != $password2) {
            $_SESSION['error-pass'] = true;
            header('location: ../edit.master.php?mk_id=' . $mk_id);
        } else {
            $hashpwd = password_hash($password, PASSWORD_BCRYPT);
            $insertUser = mysqli_query($conn, "UPDATE tbl_master_key SET name = '$name', email = '$email', username = '$username', password = '$hashpwd' WHERE mk_id = '$mk_id'") or die(mysqli_error($conn));
            $_SESSION['success-mkEdit'] = true;
            header('location: ../edit.master.php.?mk_id=' . $mk_id);
        }
    }
}