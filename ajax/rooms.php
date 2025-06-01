<?php

require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');

session_start();
date_default_timezone_set("Asia/Kolkata");


if (isset($_GET['fetch_rooms'])) {

    //check avail data decode 
    $chk_aval = json_decode($_GET['chk_aval'], true);


    // check in and out availabiltity

    if ($chk_aval['checkin'] != '' && $chk_aval['checkout'] != '') {
        // check in and out validation

        $today_date = new DateTime(date('y-m-d'));
        $checkin_date = new DateTime($chk_aval['checkin']);
        $checkout_date = new DateTime($chk_aval['checkout']);

        if ($checkin_date == $checkout_date) {
            echo "<h3 class='text-center text-danger '>Invalid Dates</h3>";
            exit();
        } else if ($checkout_date < $checkin_date) {
            echo "<h3 class='text-center text-danger '>Invalid Dates</h3>";
            exit();
        } else if ($checkin_date < $today_date) {
            echo "<h3 class='text-center text-danger '>Invalid Dates</h3>";
            exit();
        }

    }


    // Guests data decode 
    $guests = json_decode($_GET['guests'],true);
    // print_r($_GET['guests']); check data is going or not 

    $adults =($guests['adults'] != '') ? $guests['adults'] :0 ;
    $children =($guests['children'] != '') ? $guests['children'] :0 ;
    


    // facility data decode 
    $facility_list = json_decode($_GET['facility_list'],true);


    // Count no of rooms and output variable to store room cards
    $count_rooms = 0;
    $output = "";

    // fetching setting table to check website is  shutdown or not
    $setting_q = "SELECT * FROM `setting` where `sr_no`=1";
    $setting_res = mysqli_fetch_assoc(mysqli_query($con, $setting_q));


    // query for rooms cards 

    $room_res = select('SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `remove`=?', [$adults,$children,1, 0], 'iiii');


    while ($room_data = mysqli_fetch_assoc($room_res)) {

        if ($chk_aval['checkin'] != '' && $chk_aval['checkout'] != '') {

            $tb_query = "SELECT COUNT(*) AS    `total_bookings` FROM `booking_order` 
                    WHERE `booking_status`=? AND `room_id`=?
                    AND `check_out`>? AND `check_in` < ?";

            $values = ['booked', $room_data['id'], $chk_aval['checkin'], $chk_aval['checkout']];

            $tb_fetch = mysqli_fetch_assoc(select($tb_query, $values, 'siss'));

           

            if (($room_data['quantity'] - $tb_fetch['total_bookings']) <= 0) {
                continue;

            }



        }



        // Get room facilities

        $fac_count = 0;



        $fac_q = mysqli_query($con, "SELECT f.name ,f.id FROM `facilities` f INNER JOIN `rooms_facilities` rf ON f.id = rf.facilities_id WHERE rf.rooms_id = '$room_data[id]'");
        $facilities_data = '';
        while ($fac_row = mysqli_fetch_assoc($fac_q)) 
        {
            if(in_array(($fac_row['id']),$facility_list['facilities']))
            {

                $fac_count++;

            }


            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$fac_row[name]</span>";
        }

        if(count($facility_list['facilities']) !=$fac_count)
        {
            continue;

        }

        // Get room features
        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `rooms_features` rf ON f.id = rf.feature_id WHERE rf.room_id = '$room_data[id]'");
        $features_data = '';
        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$fea_row[name]</span>";
        }



        // Get Thumbnail Image
        $room_thumb = ROOM_IMG_PATH . 'thumbnail.jpg';
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumb` = 1");
        if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_row = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOM_IMG_PATH . $thumb_row['image'];
        }
        $book_btn = "";
        if (!$setting_res['shutdown']) {
            $login = 0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $login = 1;
            }
            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 text-white mb-2 custom-bg shadow-none'>Book Now</button>";
        }
        // Print room card
        $output .= "
            <div class='card mb-4  border-0 shadow'>
            <div class='row g-0 p-3 align-items-center'>
              <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                <img src='$room_thumb' class='img-fluid rounded' alt='...'>
              </div>
              <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                <h5 class='mb-3'>$room_data[name]</h5>
                <div class='features mb-3'>
                  <h6 class='mb-1'>Features</h6>
                  $features_data
                </div>
                <div class='facilities mb-3'>
                  <h6 class='mb-1'>Facilities</h6>
                   $facilities_data
                  </div>
                <div class='guests'>
                  <h6 class='mb-1'>Guest</h6>
                  <span class='badge rounded-pill bg-light text-dark text-wrap lh-base'>$room_data[adult] Adult</span>
                  <span class='badge rounded-pill bg-light text-dark text-wrap lh-base'>$room_data[children] Children</span>
                </div>
              </div>
              <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                <h6 class='mb-4'>₹$room_data[price] per night</h6>
                $book_btn
                <a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More details</a>
              </div>
            </div>
            </div>

        ";
        $count_rooms++;




    }

    if ($count_rooms > 0) {
        echo $output;
    } else {
        echo "<h3 class='text-center text-danger '>No rooms to show</h3>";
    }

}


?>