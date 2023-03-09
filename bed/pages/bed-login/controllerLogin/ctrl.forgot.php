<?php
require '../../../includes/conn.php';
session_start();
ob_start();


// PHPMailer
require '../../bed-phpmailer/src/PHPMailer.php';
require '../../bed-phpmailer/src/SMTP.php';
require '../../bed-phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "SELECT SUM(total) AS $total
    FROM 
    (SELECT COUNT(email) AS total FROM tbl_master_key WHERE email = '$email'
     UNION ALL 
     SELECT COUNT(email) AS total FROM tbl_registrars WHERE email = '$email') AS total");





    if ($total < 2) {

        $email_mk = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE email = '$email'");
        $email_reg = mysqli_query($conn, "SELECT * FROM tbl_registrars WHERE email = '$email'");

        if (mysqli_num_rows($email_mk) > 0) {
            $code = rand(100000, 999999);
            $insertCode = mysqli_query($conn, "UPDATE tbl_master_key SET activation_code = '$code' WHERE email = '$email'");

            if ($insertCode) {
                $mail = new PHPMailer(true);

                //Server settings  
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply.sfacbacoor@gmail.com';                     //SMTP username
                $mail->Password   = 'master.12345';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;

                $mail->setFrom('noreply.sfacbacoor@gmail.com');
                $mail->addAddress($email);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Activation Code';
                $mail->Body    = 'Hello ' . $email . '<br><br>We recieve a request to reset your password. You can change password by entering verification code.<br><br> Verification code: ' . $code . ' <br><br>
            Saint Francis of Assisi College - Bacoor<br>
            All rights reserved.';

                $mail->send();
                $_SESSION['sent'] = true;

                if (isset($_SESSION['sent'])) {
                    $_SESSION['email'] = $email;
                    $mail->smtpClose();
                    header("location: ../code.ver.php");
                }
            } else {
                $_SESSION['error'] = true;
                header("location: ../forgot.pwd.php");
            }
        } else if (mysqli_num_rows($email_reg) > 0) {
            $code = rand(100000, 999999);
            $insertCode = mysqli_query($conn, "UPDATE tbl_registrars SET activation_code = '$code' WHERE email = '$email'");

            if ($insertCode) {
                $mail = new PHPMailer(true);

                //Server settings  
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply.sfacbacoor@gmail.com';                     //SMTP username
                $mail->Password   = 'master.12345';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;

                $mail->setFrom('noreply.sfacbacoor@gmail.com');
                $mail->addAddress($email);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Activation Code';
                $mail->Body    = 'Hello ' . $email . '<br><br>We recieve a request to reset your password. You can change password by entering verification code.<br><br> Verification code: ' . $code . ' <br><br>
            Saint Francis of Assisi College - Bacoor<br>
            All rights reserved.';

                $mail->send();
                $_SESSION['sent'] = true;

                if (isset($_SESSION['sent'])) {
                    $_SESSION['email'] = $email;
                    $mail->smtpClose();
                    header("location: ../code.ver.php");
                }
            } else {
                $_SESSION['error'] = true;
                header("location: ../forgot.pwd.php");
            }
        } else {
            $_SESSION['error_email'] = true;
            header("location: ../forgot.pwd.php");
        }
    } else {
        $_SESSION['confirm'] = "Confirm";
        $_SESSION['email_mk'] = $email_mk;
        $_SESSION['email_reg'] = $email_reg;
        header('location: ../user.ver.php');
    }
}