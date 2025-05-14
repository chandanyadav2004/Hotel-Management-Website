<!-- Database name is hbwebsite -->
<!-- Table name  admin_cred -->
<!-- Three coloumns 1. sr_no 2. admin_name 3. admin_pass -->

<?php
// Database connection
$hname = "localhost";
$uname = "root";
$pass = '';
// Database name
$db = "hbwebsite";

$con = mysqli_connect($hname, $uname, $pass, $db);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>