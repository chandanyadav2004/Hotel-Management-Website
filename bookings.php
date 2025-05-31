<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- BOOKINGS</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


  <style>
    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }
  </style>
</head>

<body class="bg-light">

  <?php

  require('include/header.php');
  if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold "> BOOKING </h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="bookings.php" class="text-secondary text-decoration-none">BOOKING</a>
        </div>
      </div>

      <?php

      $query = "SELECT bo.*, bd.* 
            FROM `booking_order` bo  
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (
                (bo.booking_status = 'booked')
                OR (bo.booking_status = 'cancelled')
                OR (bo.booking_status = 'pending')
            )
            AND (bo.user_id=?)
            ORDER BY bo.booking_id DESC";

      $result = select($query, [$_SESSION['uId']], 'i');

      while ($data = mysqli_fetch_assoc($result)) {
        $date = date("d-m-Y", strtotime($data['datetime']));
        $checkin_date = date("d-m-Y", strtotime($data['check_in']));
        $checkout_date = date("d-m-Y", strtotime($data['check_out']));

        $status_bg = "";
        $btn = "";
        if ($data['booking_status'] == 'Booked') {
          $status_bg = 'bg-success';
          if ($data['arrival'] == 1) {
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none '>  Download PDf </a>
                <button type='button'  class='btn btn-dark btn-sm   shadow-none '>
                  Rate ANd Review </button>
            ";
          } else {
            $btn = "<button type='button' onclick='cancel_booking($data[booking_id])'  class='btn btn-danger btn-sm   shadow-none '>Cancel </button>";


          }

        } else if ($data['booking_status'] == 'cancelled') {
          $status_bg = 'bg-danger';
          if ($data['refund'] == 0) {

            $btn = "<span class='badge bg-primary'>Refund in Process!</span>";

          } else {
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none '>  Download PDf </a>";
          }


        } else {
          $status_bg = 'bg-warning text-dark';
          $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none '>  Download PDf </a>";

        }

        echo <<<bookings
          <div class='col-md-4 px-4 mb-5'>
            <div class='bg-white p-3 rounded shadow-none'>
              <h5 class='fw-bold'>$data[room_name]</h5>
              <p>₹$data[price]per Night</p>
              <p>
                <b>Check-in : </b> $checkin_date<br>
                <b>Check-out : </b> $checkout_date
              </p>
              <p>
                <b>Amount : </b> ₹$data[trans_amt]<br>
                <b>Order ID : </b> $data[order_id] <br>
                <b>Date : </b> $date
              </p>
              <p>
                <span class='badge $status_bg'>$data[booking_status]</span>
              </p>
              $btn

            </div>
          </div>

        bookings;






      }


      ?>



    </div>
  </div>


  <?php
    if(isset($_GET['cancel_status'])){
      alert("success", "Booking Cancelled ");
    }

  ?>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>

  <script>

    function cancel_booking(id) {
      if (confirm("Are you sure you want to Cancel  this Booking ?")) {
        let form_data = new FormData();
        form_data.append("booking_id", id);
        form_data.append("cancel_booking", "");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cancel_booking.php", true);
        xhr.onload = function () {
          if (this.responseText == 1) {
            window.location.href = "bookings.php?cancel_status=true";
            

          } else {
            alert("error", "server down");
          }
        };
        xhr.send(form_data);
      }
    }



  </script>




  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>