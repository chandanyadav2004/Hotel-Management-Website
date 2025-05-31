<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- CONFIRM BOOKINGS</title>
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

  <?php require('include/header.php'); ?>

  <?php

  /*
    Check room id from url is present or not 
    Shutdown mode is active or not
    Users is log in or not

  
  */

  if (!isset($_GET['id']) || $setting_res['shutdown'] == true) {
    redirect('rooms.php');
  } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('rooms.php');
  }

  // Filter and get rooms data 
  
  $data = filteration($_GET);
  $room_res = select('SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `remove`=?', [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);

  $_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
  ];

  // print_r($_SESSION['room']);
  $user_res = select('SELECT * FROM `users_cred` WHERE `id`=? LIMIT 1', [$_SESSION['uId']], 'i');
  $user_data = mysqli_fetch_assoc($user_res)

    ?>
  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold ">CONFIRM BOOKING </h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>

        </div>
      </div>

      <div class="col-lg-7 col-md-12 px-4 ">
        <?php

        $room_thumb = ROOM_IMG_PATH . 'thumbnail.jpg';
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumb` = 1");
        if (mysqli_num_rows($thumb_q) > 0) {
          $thumb_row = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOM_IMG_PATH . $thumb_row['image'];
        }
        echo <<<data
           <diV class="card p-3 shadow-sm rounded">
             <img src='$room_thumb' class='img-fluid rounded mb-3' alt='...'>
             <h5>$room_data[name]</h5>
             <h6>₹$room_data[price] per night</h6>
           
           </diV>



        data;




        ?>

      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class='card mb-4  border-0 shadow-sm rounded-3'>
          <div class="card-body">
            <form id="booking_form">
              <h6 class="mb-3">BOOKING DETAILS</h6>
              <div class="row">
                <div class="col-md-6  mb-3">
                  <label class="form-label">Name </label>
                  <input name="name" type="text" value="<?php echo $user_data['name'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-6  mb-3">
                  <label class="form-label">Phone </label>
                  <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-12  mb-3">
                  <label class="form-label ">Address </label>
                  <textarea name="address" class="form-control shadow-none"
                    rows="3"><?php echo $user_data['address'] ?></textarea>
                </div>
                <div class="col-md-6  mb-3">
                  <label class="form-label ">Check-in </label>
                  <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none"
                    required>
                </div>
                <div class="col-md-6  mb-4">
                  <label class="form-label ">Check-out </label>
                  <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none"
                    required>
                </div>
                <div class="col-12">
                  <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <h6 class="mb-3 text-danger" id="pay_info">Provide check-in and Check-out dates !</h6>
                  <button name="pay_now" id="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-1"
                    disabled>Pay
                    Now</button>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>






    </div>
  </div>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>

  <script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');
    let pay_now = document.getElementById('pay_now');



    function check_availability() {
      pay_info.classList.add('d-none');
      pay_info.classList.replace('text-dark', 'text-danger');
      info_loader.classList.remove('d-none');

      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;


      booking_form.elements['pay_now'].setAttribute('disabled', true);

      if (checkin_val != '' && checkout_val != '') {
        let data = new FormData();

        data.append('check_availability', '');
        data.append('check_in', checkin_val);
        data.append('check_out', checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/confirm_booking.php", true);
        xhr.onload = function () {
          let data = JSON.parse(this.responseText);
          if (data.status == 'check_in_out_equal') {
            pay_info.innerText = 'You cannot check in-out on same day';
          } else if (data.status == 'check_out_earlier') {
            pay_info.innerText = 'Check_out date earlier than check-in day';
          } else if (data.status == 'check_in_earlier') {
            pay_info.innerText = 'Check_in date earlier than check_out day';
          } else if (data.status == 'Unavailable') {
            pay_info.innerText = ' Room Not availabe for this .Check_in date ';
          } else {
            pay_info.innerHTML = "No. of Days: " + data.days + "<br> Total amount to pay: ₹" + data.payment;
            pay_info.classList.replace('text-danger', 'text-dark');
            booking_form.elements['pay_now'].removeAttribute(['disabled']);


          }

          pay_info.classList.remove('d-none');
          info_loader.classList.add('d-none');
          document.getElementById('pay_now').addEventListener('click', function (event) {
            event.preventDefault();
            startPayment();
          });
        };

        xhr.send(data);

      }


    }

    function startPayment() {
      // Call backend to create Razorpay order
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "pay_now.php", true);
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;
      let address = booking_form.elements['address'].value;
      let data = new FormData();
      data.append('create_order', '');
      data.append('checkin', checkin_val);
      data.append('checkout', checkout_val);
      data.append('address', address);

      // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        let res = JSON.parse(this.responseText);
        console.log(res);

        var options = {
          "key": "rzp_test_U3eaz43mce5VWW",
          "amount": res.amount,
          "currency": "INR",
          // "name": res.user_name,
          "description": "Hotel Room Booking",
          "image": "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
          "order_id": res.order_id,
          "handler": function (response) {
            alert("success", `Payment successful. Razorpay Payment ID: ${response.razorpay_payment_id}`);
            let trans_id = response.razorpay_payment_id;
            let order_id = response.razorpay_order_id;
            transationVerify(trans_id, order_id);


            // You should send response.razorpay_payment_id to server for verification and booking confirmation.
          },
          "theme": {
            "color": "#3399cc"
          }
        };

        var rzp = new Razorpay(options);
        rzp.open();

        rzp.on('payment.failed', function (response) {

          alert(response.error.reason);

        })


      };


      xhr.send(data);
    }


    function transationVerify(trans_id, order_id) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "pay_now.php", true);
      let data = new FormData();
      data.append('transationVerify', true);
      data.append('trans_id', trans_id);
      data.append('order_id', order_id);

      xhr.onload = function () {
        if (this.responseText.trim() == '1') {
          alert("success", "Your Booking is Confirmed!");

        } else {
          alert("error", "Transaction verification failed!");
        }
      };
      window.location.href = 'pay_status.php?order=' + order_id;
      xhr.send(data);
    }





  </script>



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>