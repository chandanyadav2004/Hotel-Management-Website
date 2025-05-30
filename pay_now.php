<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('include/razorpay-php-master/Razorpay.php');

use Razorpay\Api\Api;

session_start();

header('Content-Type: application/json');

// Replace with your real Razorpay test keys
$api_key = 'rzp_test_U3eaz43mce5VWW';
$api_secret = 'v71SbrLePCxkt6i8QjX6iKlC';




if (isset($_POST['create_order'])) {
    if (!isset($_SESSION['room']['payment']) || $_SESSION['room']['payment'] <= 0) {
        echo json_encode(['error' => 'Invalid payment amount']);
        exit;
    }
    // echo json_encode($_SE)
    $api = new Api($api_key, $api_secret);

    $order = $api->order->create([
        'receipt' => 'ORD_' . $_SESSION['uId'] . '_' . rand(1000, 99999),
        'amount' => $_SESSION['room']['payment'] * 100, // in paise
        'currency' => 'INR'

    ]);
   
    


    // Insert payment data into database 
    $frm_data = filteration($_POST);
    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`) 
    VALUES (?,?,?,?,?)";

    insert($query1, [$_SESSION['uId'], $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $order['id']], 'issss');

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,`user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($query2, [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $_SESSION['room']['payment'], $_SESSION['uName'], $_SESSION['uPhone'], $frm_data['address']], 'issssss');




    echo json_encode([
        'order_id' => $order['id'],
        'amount' => $order['amount'] * 100,

    ]);

    
}

if (isset($_POST['transationVerify'])) {
    

    $frm_data = filteration($_POST);

    $trans_id = $frm_data['trans_id'];
    $order_id = $frm_data['order_id'];


    

    $trans_status = 'Success'; // You can update this based on actual verification
    $trans_amt = $_SESSION['room']['payment']; // Assuming this was set earlier
    $booking_status = 'Booked'; // or whatever status you use

    $query = "UPDATE `booking_order` SET 
                `booking_status` = ?, 
                `trans_id` = ?, 
                `trans_amt` = ?, 
                `trans_status` = ?
              WHERE `order_id` = ?";

    $res=insert($query, [$booking_status, $trans_id, $trans_amt, $trans_status, $order_id], 'sssss');
    if($res){
        
    unset($_SESSION['room']);

    }

    

    



}




?>