<?php

/* Database name is hbwebsite
Table name  admin_cred
Three coloumns 1. sr_no 2. admin_name 3. admin_pass */

?>

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


function filteration($data)
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            // Recursively sanitize sub-arrays if needed
            $data[$key] = filteration($value);
        } else {
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
    }
    return $data;
}


function select($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed: select" . mysqli_error($con));
        }


    } else {
        die("Query cannot be prepared: Select" . mysqli_error($con));
    }
}


function update($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed: Update" . mysqli_error($con));
        }


    } else {
        die("Query cannot be prepared: Update" . mysqli_error($con));
    }
}

function insert($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed: Insert" . mysqli_error($con));
        }


    } else {
        die("Query cannot be prepared: Insert" . mysqli_error($con));
    }
}


function selectAll($table)
{
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    if ($res) {
        return $res;
    } else {
        die("Query cannot be executed: selectAll" . mysqli_error($con));
    }
}

function delete($sql, $values, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed: Delete" . mysqli_error($con));
        }
    } else {
        die("Query cannot be prepared: Delete" . mysqli_error($con));
    }
}




?>