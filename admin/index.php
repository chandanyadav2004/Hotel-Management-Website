<?php
require('inc/essentials.php');
require('inc/db_config.php');
session_start();
        if(!(isset($_SESSION['admin_login']) && $_SESSION['admin_login']==true)){
            redirect('dashboard.php');
            
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chandan Yadav Hotel - Admin Panel </title>
    <?php require('inc/links.php') ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center shadow overflow-hidden bg-white rounded">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center"
                        placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center"
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn  text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>



    <?php

    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name` = ? AND `admin_pass` = ?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $datatypes = "ss";

        $res = select($query, $values, $datatypes);

        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION["admin_id"] = $row["sr_no"];
            $_SESSION['admin_login'] = true;
            redirect('dashboard.php');

        } else {
            alert('error', 'Invalid Credentials');
        }
        // print_r($res);
    
    }

    ?>




    <?php require('inc/scripts.php'); ?>
</body>

</html>