<?php
require('../inc/essentials.php');
require('../inc/db_config.php');
adminLogin();


if (isset($_POST['get_booking'])) {

    $frm_data = filteration($_POST);

    $limit = 3;
    $page = $frm_data['page'];
    $start = ($page - 1) * $limit;
    // echo $frm_data['search'];

    $query = "SELECT bo.*, bd.* 
            FROM `booking_order` bo  
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (
                (bo.booking_status = 'booked' AND bo.arrival = 1)
                OR (bo.booking_status = 'cancelled' AND bo.refund = 1)
                OR (bo.booking_status = 'pending')
            )
            AND (
                bo.order_id LIKE ?
                OR bd.phonenum LIKE ?
                OR bd.user_name LIKE ?
            )
            ORDER BY bo.booking_id DESC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"], 'sss');

    $limit_query = $query . " LIMIT $start,$limit";
    $limit_res = select($limit_query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"], 'sss');


    $i = $start + 1;

    $total_rows = mysqli_num_rows($res);


    if ($total_rows == 0) {
        $output = json_encode(['table_data' => "<b>No Data Found</b>", "pagination" => '']);
        echo $output;
        exit;
    }


    $table_data = "";

    while ($data = mysqli_fetch_assoc($limit_res)) {
        $date = date("d-m-Y", strtotime($data['datetime']));
        $checkin_date = date("d-m-Y", strtotime($data['check_in']));
        $checkout_date = date("d-m-Y", strtotime($data['check_out']));

        if ($data['booking_status'] == 'Booked') {
            $status_bg = 'bg-success';
        } else if ($data['booking_status'] == 'cancelled') {
            $status_bg = 'bg-danger';
        } else {
            $status_bg = 'bg-warning text-dark';
        }

        $table_data .= "
        <tr>
            <td>$i</td>
            <td>
                <span class='badge bg-primary'>
                    Order ID: $data[order_id]
                </span>
                <br>
                <b>Name : </b>$data[user_name]
                <br>
                <b>Phone No. : </b>$data[phonenum]
            </td>
            <td>
                <b>Room:</b> $data[room_name]
                <br>
                <b>Price :₹</b> $data[price]
            </td>
            <td>
                <b>Amount: ₹</b> $data[trans_amt]
                <br>
                <b>Date :</b> $date
            </td>
            <td>
                <span class='badge $status_bg '>$data[booking_status]</span>
            </td>
            <td>
            
                <button type='button' onclick='download($data[booking_id])' class='btn btn-outline-success btn-sm fw-bold  shadow-none '>
                  <i class='bi bi-file-earmark-arrow-down-fill'></i>
                </button>
                
            </td>
        
        </tr>
        
        ";
        $i++;
    }

    $pagination = "";
    if ($total_rows > $limit) {
        // $pagination=$total_rows;
        $total_pages = ceil($total_rows / $limit);
        // echo $total_pages;

        if ($page != 1) {
            $pagination .= "<li class='page-item '>
            <button onclick='change_page(1)' class='page-link shadow-none'>First</button>
            </li>";
        }


        $disabled = ($page == 1) ? "disabled" : "";
        $prev = $page - 1;
        $pagination .= "<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>Previous</button></li>";


        $next = $page + 1;

        $disabled = ($page == $total_pages) ? "disabled" : "";

        $pagination .= "<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'>Next</button></li>";

        if ($page != $total_pages) {
            $pagination .= "<li class='page-item '>
            <button onclick='change_page($total_pages)' class='page-link shadow-none'>Last</button>
            </li>";
        }
        

    }

    $output = json_encode(['table_data' => $table_data, "pagination" => $pagination]);
    echo $output;


}







if (isset($_POST['assign_room'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd 
    ON bo.booking_id=bd.booking_id 
    SET bo.arrival =?,bd.room_no = ? where bo.booking_id =? ";

    $values = [1, $frm_data['room_no'], $frm_data['booking_id']];
    $res = update($query, $values, 'isi');

    echo ($res == 2) ? 1 : 0; // IT will update 2 rows so it will return 2

}






if (isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET `booking_status`=? ,`refund`=?  where `booking_id` =? ";

    $values = ['cancelled', 0, $frm_data['booking_id']];
    $res = update($query, $values, 'sii');



    echo $res;
    // print_r($res);
}



if (isset($_POST['search_user'])) {
    $frm_data = filteration($_POST);

    $query = "SELECT * FROM `users_cred` WHERE `name` LIKE ?";

    $res = select($query, ["%$frm_data[name]%"], 's');
    $i = 1;
    $url = SITE_URL;
    $path = USERS_IMG_PATH;

    $data = '';
    while ($row = mysqli_fetch_assoc($res)) {

        $del_btn = "
        <button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
            <i class='bi bi-trash'></i>
        </button> ";

        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
        if ($row['is_verified'] == 1) {
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $del_btn = '';

        }
        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";

        if (!$row['status']) {
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>inactive</button>";
        }

        $date = date("d-m-Y", strtotime($row['dateTime']));

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                <img src='$url$path$row[profile]' width='55px'>
                $row[name]</td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address] $row[pincode]</td>
                <td>$row[dob]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>

            
            </tr>
        
        ";
        $i++;
    }

    echo $data;
}


?>