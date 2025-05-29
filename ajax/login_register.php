<?php

require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('../include/PHPMailer-master/PHPMailer-master/src/Exception.php');
require ('../include/PHPMailer-master/PHPMailer-master/src/PHPMailer.php');
require ('../include/PHPMailer-master/PHPMailer-master/src/SMTP.php');




// require 'vendor/autoload.php'; 

function sendMail($email, $name, $token)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP server config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'demo8788151949@gmail.com';
        $mail->Password = 'pyrqrqpvkfotksdw'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Email headers & body
        $mail->setFrom('demo8788151949@gmail.com', 'Chandan Hotel');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification Link';
        $mail->Body = "Hi $name,<br><br>
            Click below to verify your email:<br>
            <a href='".SITE_URL."email_confirm.php?email_confirmation&email=$email&token=$token"."'>Verify Email</a><br><br>
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
    $u_exist = select('SELECT * FROM `users_cred` WHERE `email`=?  AND `phonenum`=? LIMIT 1', [$data['email'], $data['phonenum']], 'ss');

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
    $res_mail=sendMail($data['email'],$data['name'],$token);

    if($res_mail == 0){
        echo "mail_failed";
        exit;
    }

    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
    $q = "INSERT INTO `users_cred`(`name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `token`) 
        VALUES (?,?,?,?,?,?,?,?,?)";

    $values=[$data['name'],$data['email'],$data['phonenum'],$img,$data['address'],$data['pincode'],$data['dob'],$enc_pass,$token];

    if(insert($q,$values,'sssssssss')){
        echo 1;
    }else{
        echo 'ins_failed';
    }



}


?>