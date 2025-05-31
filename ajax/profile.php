<?php

require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');

session_start();

date_default_timezone_set("Asia/Kolkata");

if (isset($_POST['info_form'])) {
    $frm_data = filteration($_POST);
    // print_r($frm_data);

    // Phone no check
    $u_exist = select('SELECT * FROM `users_cred` WHERE  `phonenum`=? AND `id` != ?  LIMIT 1', [$frm_data['phonenum'], $_SESSION['uId']], 'si');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo 'phone_already';
        exit;
    }

    $query = "UPDATE `users_cred` SET `name` = ?, `phonenum` = ?, `address` = ?, `pincode` = ?, `dob` = ? WHERE `id` = ?";
    $values = [
        $frm_data['name'],
        $frm_data['phonenum'],
        $frm_data['address'],
        $frm_data['pincode'],
        $frm_data['dob'],
        $_SESSION['uId']
    ];

    // Correct types: s = string, i = integer
    if (update($query, $values, 'ssssss')) {
        $_SESSION['uName'] = $frm_data['name'];
        echo 1;
    } else {
        echo 0;
    }





}

if (isset($_POST['profile_form'])) {

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo "invalid_image";
        exit;
    } else if ($img == 'upd_failed') {
        echo "Upd_Failed";
        exit;
    }

    // fetching old image and deleting it

    $u_exist = select('SELECT `profile` FROM `users_cred` WHERE  `id` = ?  LIMIT 1', [$_SESSION['uId']], 'i');
    $u_exist_fetch = mysqli_fetch_assoc($u_exist);

    deleteImage($u_exist_fetch['profile'], USERS_FLODER);





    $query = "UPDATE `users_cred` SET `profile` = ? WHERE `id` = ?";
    $values = [$img, $_SESSION['uId']];

    // Correct types: s = string, i = integer
    if (update($query, $values, 'ss')) {
        $_SESSION['uPic'] = $img;
        echo 1;
    } else {
        echo 0;
    }





}

if (isset($_POST['pass_form'])) {

    $frm_data = filteration($_POST);

    if($frm_data['new_pass'] !=$frm_data['confirm_pass']){
        echo 'pass_mismatch';
        exit;
    }

    $enc_pass = password_hash($frm_data['new_pass'], PASSWORD_BCRYPT);


    $query = "UPDATE `users_cred` SET `password` = ? WHERE `id` = ? LIMIT 1";
    $values = [$enc_pass, $_SESSION['uId']];

    // Correct types: s = string, i = integer
    if (update($query, $values, 'ss')) {
        // $_SESSION['uPic'] = $img;
        echo 1;
    } else {
        echo 0;
    }





}

?>