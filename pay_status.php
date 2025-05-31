<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- Booking Status</title>
  <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->


  <style>
    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }
  </style>
</head>

<body class="bg-light">

  <?php require('include/header.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold ">PAYMENT STATUS </h2>
        <?php
        if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
          redirect('index.php');
        }
        if (!isset($_SESSION['uId'])) {
          redirect('index.php');
        }

        $frm_data = filteration($_GET); // because you're passing order in URL
        
        $booking_q = "SELECT bo.*, bd.* FROM `booking_order` bo  INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
        WHERE bo.order_id = ? AND bo.user_id = ? AND bo.booking_status != ?";

        $booking_res = select($booking_q, [$frm_data['order'], $_SESSION['uId'], 'pending'], 'sss');

        $booking_fetch = mysqli_fetch_assoc($booking_res);


        if (!$booking_res || mysqli_num_rows($booking_res) == 0) {
          redirect('index.php');
          exit;
        }

        // if (mysqli_num_rows($booking_res) == 0) {
        //   redirect('index.php');
        // }else
        if ($booking_fetch['trans_status'] == 'Success') {
          echo <<<data
          <div class="col-12 px-4">
            <p class="fw-bold alert alert-success">
              <i class="bi bi-check-circle-fill"></i>
              Payment done! Booking Succesfully
              <br><br>
              <a href='bookings.php'>Go to Bookings</a>
            </p>
          </div>
          data;
        } else {
          echo <<<data
          <div class="col-12 px-4">
            <p class="fw-bold alert alert-success">
              <i class="bi bi-exclamation-triangle"></i>
              Payment Failed! Booking Unsuccesfully
              <br><br>
              <a href='bookings.php'>Go to Bookings</a>
            </p>
          </div>
          data;

        }
        ?>

      </div>

    </div>
  </div>

  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>