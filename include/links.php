<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap">
<link rel="stylesheet" href="CSS/common.css">

<?php require('admin/inc/essentials.php') ?>
<?php require('admin/inc/db_config.php') ?>
<?php

session_start();

$contact_q = "SELECT * FROM `contact_details` where `sr_no`=?";
$setting_q = "SELECT * FROM `setting` where `sr_no`=?";

$values = [1];
$contact_res = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
$setting_res = mysqli_fetch_assoc(select($setting_q, $values, 'i'));

// print_r($contact_res);

?>