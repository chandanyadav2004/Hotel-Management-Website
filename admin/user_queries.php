<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if(isset(($_GET['seen']))){
    $frm_data = filteration($_GET);

    if($frm_data['seen']== 'all'){
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        $res = update($q, $values, 'i');
        if($res==1){
            alert('success', 'Query marked all as read');
        }
        else{
            alert('error', 'Unable to mark query  all as read');
        }
        header('Location: user_queries.php');
        exit;
        
    }
    else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        $res = update($q, $values, 'ii');
        if($res==1){
            alert('success', 'Query marked as read');
        }
        else{
            alert('error', 'Unable to mark query as read');
        }
        header('Location: user_queries.php');
        exit;
    }
}
if(isset(($_GET['del']))){
    $frm_data = filteration($_GET);

    if($frm_data['del']== 'all'){
        $q = "DELETE FROM `user_queries` ";
        
        if(mysqli_query($con, $q)){
            alert('success', 'Deleted all queries');
        }
        else{
            alert('error', 'Operation failed');
        }
        header('Location: user_queries.php');
        exit;
        
    }
    else{
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete($q,  $values, 'i')){
            alert('success', 'Deleted as read');
        }
        else{
            alert('error', 'Unable to unable as read');
        }
        header('Location: user_queries.php');
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - USER QUERIES</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">USERS QUERIES</h3>

                <!-- Users Queries section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button><a href="?seen=all" class="btn btn-sm rounded-pill btn-primary"><i class="bi bi-check-all"></i> Mark all as read</a></button>
                            <button><a href="?del=all" class="btn btn-sm rounded-pill btn-danger"><i class="bi bi-trash"></i> Delete all</a></button>
                        </div>


                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top ">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subjects</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM `user_queries` order by `sr_no` desc";
                                    $data = mysqli_query($con, $q);
                                    $i = 1; 
                                    while ($row = mysqli_fetch_assoc($data)) {
                                       $seen='';
                                        if($row['seen']!=1){
                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm  rounded-pill btn-primary'>Mark as read</a><br>";
                                        }
                                        $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm  rounded-pill btn-danger mt-2'>Delete</a>";

                                        echo <<<data
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[name]</td>
                                                <td>$row[email]</td>
                                                <td>$row[subject]</td>
                                                <td>$row[message]</td>
                                                <td>$row[date]</td>

                                                <td>$seen</td>
                                            </tr>



                                        data;
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php require('inc/scripts.php') ?>

</body>

</html>