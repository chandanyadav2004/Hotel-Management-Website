<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if(isset(($_GET['seen']))){
    $frm_data = filteration($_GET);

    if($frm_data['seen']== 'all'){
        $q = "UPDATE `rate_review` SET `seen`=?";
        $values = [1];
        $res = update($q, $values, 'i');
        if($res==1){
            alert('success', 'Query marked all as read');
        }
        else{
            alert('error', 'Unable to mark query  all as read');
        }
        
    }
    else{
        $q = "UPDATE `rate_review` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        $res = update($q, $values, 'ii');
        if($res==1){
            alert('success', 'Query marked as read');
        }
        else{
            alert('error', 'Unable to mark query as read');
        }
        
    }
}
if(isset(($_GET['del']))){
    $frm_data = filteration($_GET);

    if($frm_data['del']== 'all'){
        $q = "DELETE FROM `rate_review` ";
        
        if(mysqli_query($con, $q)){
            alert('success', 'Deleted all queries');
        }
        else{
            alert('error', 'Operation failed');
        }
        
        
    }
    else{
        $q = "DELETE FROM `rate_review` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete($q,  $values, 'i')){
            alert('success', 'Deleted as read');
        }
        else{
            alert('error', 'Unable to unable as read');
        }
        // header('Location: rate_review.php');
        // exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rating & Reviews</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">RATING & REVIEWS </h3>

                <!-- Users Queries section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button><a href="?seen=all" class="btn btn-sm rounded-pill btn-primary"><i class="bi bi-check-all"></i> Mark all as read</a></button>
                            <button><a href="?del=all" class="btn btn-sm rounded-pill btn-danger"><i class="bi bi-trash"></i> Delete all</a></button>
                        </div>


                        <div class="table-responsive-md" >
                            <table class="table table-hover border">
                                <thead class="sticky-top ">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#.</th>
                                        <th scope="col">Room Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col" >Rating</th>
                                        <th scope="col" >Review</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT rr.*,uc.name AS uname, r.name AS rname FROM `rate_review` rr 
                                     INNER JOIN `users_cred` uc ON rr.user_id=uc.id
                                     INNER JOIN `rooms` r ON rr.room_id=r.id
                                     order by `sr_no` desc";
                                    $data = mysqli_query($con, $q);
                                    $i = 1; 
                                    while ($row = mysqli_fetch_assoc($data)) 
                                    {
                                        $date = date('d-m-y',strtotime($row['datetime']));
                                       $seen='';
                                        if($row['seen']!=1){
                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm  rounded-pill btn-primary'>Mark as read</a> <br>";
                                        }
                                        $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm  rounded-pill btn-danger mt-2'>Delete</a>";

                                        echo <<<data
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[rname]</td>
                                                <td>$row[uname]</td>
                                                <td>$row[rating]</td>
                                                <td>$row[review]</td>
                                                <td>$date</td>
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