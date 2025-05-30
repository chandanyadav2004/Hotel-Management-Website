<?php

require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');
date_default_timezone_set("Asia/Kolkata");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../include/PHPMailer-master/PHPMailer-master/src/Exception.php');
require('../include/PHPMailer-master/PHPMailer-master/src/PHPMailer.php');
require('../include/PHPMailer-master/PHPMailer-master/src/SMTP.php');



// require 'vendor/autoload.php'; 

function sendMail($email, $token, $type)
{
    if ($type == 'email_confirmation') {
        $page = 'email_confirm.php';
        $subject = "Account Verification  links ";
        $content = "Confirm Your Links ";
    } else {
        $page = 'index.php';
        $subject = "Account Reset  links ";
        $content = "Reset  Your Account ";
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP server config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = PHP_MAIL_EMAIL;
        $mail->Password = PHP_MAIL_PASS; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Email headers & body
        $mail->setFrom(PHP_MAIL_EMAIL, PHP_MAIL_NAME);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "Hi Users,<br><br>
            Click below to $content<br>
            <a href='" . SITE_URL . "$page?$type&email=$email&token=$token" . "'>Verify Email</a><br><br>
            If you didn’t register, ignore this email.";

        $mail->send();
        return 1;
    } catch (Exception $e) {
        return 0;
    }

}

if (isset($_POST['register'])) {

    $data = filteration($_POST);

    // Match Password and cnf Password
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }
    // check users exists or not 
    $u_exist = select('SELECT * FROM `users_cred` WHERE `email`=?  OR `phonenum`=? LIMIT 1', [$data['email'], $data['phonenum']], 'ss');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Profile Image Upload

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo "invalid_image";
        exit;
    } else if ($img == 'upd_failed') {
        echo "Upd_Failed";
        exit;
    }

    // Send confirmation link to users email

    $token = bin2hex(random_bytes(16));
    $type = 'email_confirmation';

    $res_mail = sendMail($data['email'], $token, $type);

    if ($res_mail == 0) {
        echo "mail_failed";
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $q = "INSERT INTO `users_cred`(`name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `token`) 
        VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'], $data['email'], $data['phonenum'], $img, $data['address'], $data['pincode'], $data['dob'], $enc_pass, $token];

    if (insert($q, $values, 'sssssssss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }



}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $u_exist = select(
        'SELECT * FROM `users_cred` WHERE `email`=?  OR `phonenum`=? LIMIT 1',
        [$data['email_mob'], $data['email_mob']],
        'ss'
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob';
        exit;
    } else {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_exist_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            if (!password_verify($data['pass'], $u_exist_fetch['password'])) {
                echo 'invalid_pass';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_exist_fetch['id'];         // User ID
                $_SESSION['uName'] = $u_exist_fetch['name'];       // User's name
                $_SESSION['uPic'] = $u_exist_fetch['profile'];    // Profile picture
                $_SESSION['uPhone'] = $u_exist_fetch['phonenum'];   // Phone number
                // $_SESSION['uAddress'] = $u_exist_fetch['address'];    // Address
                $_SESSION['uPincode'] = $u_exist_fetch['pincode'];    // Pincode

                echo 1;
            }

        }

    }
}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exist = select(
        'SELECT * FROM `users_cred` WHERE `email`=? LIMIT 1',
        [$data['email']],
        's'
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';
        exit;
    } else {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_exist_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            $token = bin2hex(random_bytes(16));
            if (!sendMail($data['email'], $token, 'account_recovery')) {
                echo "mail_failed";
            } else {
                $date = date("y-m-d");
                $query = mysqli_query($con, "UPDATE `users_cred` SET `token` = '$token', `t_expire` = '$date' WHERE `id` = '$u_exist_fetch[id]' ");
                if ($query) {
                    echo 1;
                } else {
                    echo "upd_failed";
                }
            }


        }
    }

}

if (isset($_POST['recovery_user'])) {
    $data = filteration($_POST);
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $sql = "UPDATE `users_cred` SET `password`=?, `token`=?, `t_expire`=? WHERE `email`=? AND `token`=? ";
    $values = [$enc_pass, null, null, $data['email'], $data['token']];
    $res = update($sql, $values, 'sssss');


    if ($res) {
        echo 1;
    } else {
        echo 'failed';
    }


}

?>