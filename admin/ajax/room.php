<?php
require('../inc/essentials.php');
require('../inc/db_config.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);

    $flag = 0;

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['description']
    ];

    if (insert($q1, $values, 'siiiiis')) {
        $flag = 1;
    }

    $room_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `rooms_facilities`( `rooms_id`, `facilities_id`) VALUES (?,?)";
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $fa) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $fa);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);

    } else {
        $flag = 0;
        die('Query cannot be prepared - insert');

    }

    $q3 = "INSERT INTO `rooms_features`(`room_id`, `feature_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $fa) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $fa);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);

    } else {
        $flag = 0;
        die('Query cannot be prepared - insert');

    }


    if ($flag) {
        echo 1;

    } else {
        echo 0;
    }


}

if (isset($_POST['get_all_rooms'])) {
    $res = select("SELECT * FROM `rooms` WHERE `remove`=?", [0], 'i');
    $i = 1;
    $data = '';
    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['status'] == 1) {
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        } else {
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }

        $data .= "<tr class='align-middle'>
            <td>$i</td>
            <td>$row[name]</td>
            <td>$row[area] sq.ft</td>
            <td>
               <span class='badge bg-light text-dark rounded-pill'>Adult: $row[adult]</span><br>
                <span class='badge bg-light text-dark rounded-pill'>Children: $row[children]</span>
            </td>
            <td>₹$row[price]</td>
            <td>$row[quantity]</td>
            <td>$status</td>
            <td>
                <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal'data-bs-target='#edit-room'>
                    <i class='bi bi-pencil-square '></i>
                </button>
                <button type='button' onclick=\"room_images($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal'data-bs-target='#room-images'>
                    <i class='bi bi-images '></i>
                </button>
                <button type='button' onclick='remove_room($row[id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i>
                </button>
            </td>
        </tr>";
        $i++;
    }

    echo $data;
}

if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);
    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
    $values = [$frm_data['status'], $frm_data['toggle_status']];
    if (update($q, $values, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['edit_room'])) {
    $frm_data = filteration($_POST);

    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    // print_r($_POST);

    $flag = 0;

    // Update room details
    $q1 = "UPDATE `rooms` SET `name`=?, `area`=?, `price`=?, `quantity`=?, `adult`=?, `children`=?, `description`=? WHERE `id`=?";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['description'],
        $frm_data['room_id']
    ];

    
    if (update($q1, $values, 'siiiiisi')) {
        $flag = 1;
    }

    // Delete old features and facilities
    $del_features = delete("DELETE FROM `rooms_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $del_facilities = delete("DELETE FROM `rooms_facilities` WHERE `rooms_id`=?", [$frm_data['room_id']], 'i');

    if (!($del_features && $del_facilities)) {
        $flag = 0;
    }

    $q2 = "INSERT INTO `rooms_facilities`( `rooms_id`, `facilities_id`) VALUES (?,?)";
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $fa) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $fa);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        $flag = 1;

    } else {
        $flag = 0;
        die('Query cannot be prepared - insert');

    }

    $q3 = "INSERT INTO `rooms_features`(`room_id`, `feature_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $fa) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $fa);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);

    } else {
        $flag = 0;
        die('Query cannot be prepared - insert');

    }


    if ($flag) {
        echo 1;

    } else {
        echo 0;
    }



}

if (isset($_POST['get_room'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_room']], 'i');
    $res2 = select("SELECT * FROM `rooms_features` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
    $res3 = select("SELECT * FROM `rooms_facilities` WHERE `rooms_id`=?", [$frm_data['get_room']], 'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['feature_id']);

        }
    } else {
        $features = [];
    }

    $facilities = [];
    if (mysqli_num_rows($res3) > 0) {
        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($facilities, $row['facilities_id']);
        }
    } else {
        $facilities = [];
    }




    $data = [
        'room' => $roomdata,
        'features' => $features,
        'facilities' => $facilities
    ];
    $data = json_encode($data);
    echo $data;


}

if (isset($_POST['add_image'])) {
    $frm_data = filteration($_POST);

    $img_r=uploadImage($_FILES['image'], ROOM_FLODER);
    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo  $img_r;
    } else {
        $q = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['room_id'], $img_r];
        $res = insert($q, $values, 'is');
        echo $res;
    }


}

if (isset($_POST['get_room_images'])) {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['get_room_images']], 'i');

    $path = ROOM_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        if($row['thumb']==1){
            $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
        }else {
            $thumb_btn= "<button  onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none btn-sm'>
                    <i class='bi bi-check-lg'></i>
                </button>";
        }
        echo "
            <tr class='align-middle'>
            <td>
                <img src='$path$row[image]' class='img-thumbnail' style='width: 100px; height: 100px; object-fit: cover;'>
            </td>
            <td>$thumb_btn</td>
            <td>
                <button  onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash3-fill'></i>
                </button>
            </td>
            ";
        
        
    }


}

if (isset($_POST['rem_image'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'], $frm_data['room_id']];

    $pre_q = "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);
     
    if (deleteImage($img['image'], ROOM_FLODER)) {
        $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
        $res = delete($q, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }
}

if (isset($_POST['thumb_image'])) {
    $frm_data = filteration($_POST);
    
    $pre_q= "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
    $pre_v = [0, $frm_data['room_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');

    $q= "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
    $v = [1,$frm_data['image_id'] ,$frm_data['room_id']];
    $res = update($q, $v, 'iii');

    echo $res;
    // print_r($res);
}

if (isset($_POST['remove_room'])) {
    $frm_data = filteration($_POST);
    
    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['remove_room']], 'i');
    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], ROOM_FLODER);
    }

    $res2 = delete("DELETE FROM `rooms_features` WHERE `room_id`=?", [$frm_data['remove_room']], 'i');
    $res3 = delete("DELETE FROM `rooms_facilities` WHERE `rooms_id`=?", [$frm_data['remove_room']], 'i');
    $res4 = delete("DELETE FROM `room_images` WHERE `room_id`=?", [$frm_data['remove_room']], 'i');
    $res5 = update("UPDATE `rooms` SET `remove`=? WHERE `id`=?", [1,$frm_data['remove_room']], 'ii');

    if($res2 | $res3 || $res4 || $res5){
        echo 1;    
    }else {
        echo 0;
    }

    // echo $res;
    // print_r($res);
}


?>