<?php

require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
require('admin/inc/mPDF/vendor/autoload.php');


if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
  }


if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*, uc.* 
          FROM `booking_order` bo  
          INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
          INNER JOIN `users_cred` uc ON bo.user_id = uc.id
          WHERE (
              (bo.booking_status = 'booked' AND bo.arrival = 1)
              OR (bo.booking_status = 'cancelled' AND bo.refund = 1)
              OR (bo.booking_status = 'pending')
          )
          AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($con, $query);

    $total_rows = mysqli_num_rows($res);


    if ($total_rows == 0) {
        header('location: index.php');
        exit;
    }
    $data = mysqli_fetch_assoc($res);
    $date = date("d-m-Y", strtotime($data['datetime']));
    $checkin_date = date("d-m-Y", strtotime($data['check_in']));
    $checkout_date = date("d-m-Y", strtotime($data['check_out']));

    // require_once __DIR__ . '/vendor/autoload.php'; // make sure mPDF is loaded

    // Sample: you should already have $data and $date set appropriately

    $table_data = "
    <h2 style='text-align:center;'>BOOKING RECEIPT</h2>
    <table border='1' cellpadding='10' cellspacing='0' width='100%'> 
        <tr>
            <td><strong>Order ID:</strong> {$data['order_id']}</td>
            <td><strong>Booking Date:</strong> {$date}</td>
        </tr>
        <tr>
            <td colspan='2'><strong>Status:</strong> {$data['booking_status']}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong> {$data['user_name']}</td>
            <td><strong>Email:</strong> {$data['email']}</td>
        </tr>
        <tr>
            <td><strong>Phone No.:</strong> {$data['phonenum']}</td>
            <td><strong>Address:</strong> {$data['address']}</td>
        </tr>
        <tr>
            <td><strong>Room Name:</strong> {$data['room_name']}</td>
            <td><strong>Cost:</strong> ₹{$data['price']} per night</td>
        </tr>
        <tr>
            <td><strong>Check-in:</strong> {$data['check_in']}</td>
            <td><strong>Check-out:</strong> {$data['check_out']}</td>
        </tr>";

    if ($data['booking_status'] == 'cancelled') {
        $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";
        $table_data .= "
        <tr>
            <td><strong>Amount Paid:</strong> {$data['trans_amt']}</td>
            <td><strong>Refund:</strong> {$refund}</td>
        </tr>";
    } else if ($data['booking_status'] == 'pending') {
        $table_data .= "
        <tr>
            <td><strong>Transaction Amount:</strong> {$data['trans_amt']}</td>
            <td><strong>Failure:</strong> Your Payment has Failed</td>
        </tr>";
    } else {
        $table_data .= "
        <tr>
            <td><strong>Room No.:</strong> {$data['room_no']}</td>
            <td><strong>Amount Paid:</strong> {$data['trans_amt']}</td>
        </tr>";
    }

    $table_data .= "</table>";

    // Generate PDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['order_id'] . '.pdf', 'D'); // 'D' forces download



} else {
    header('location: index.php');
}



?>