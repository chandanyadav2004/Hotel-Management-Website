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
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none '>  Download PDf </a>";

            if ($data['rate_reviews'] == 0) {
              $btn .= "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal'  class='btn ms-2 btn-dark btn-sm   shadow-none '>
                  Rate And Review </button> ";
            }
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

  <!-- Rate and Review Modal -->
  <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="review-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex aligns-items-center">
              <i class="bi bi-chat-square-heart fs-3 me-2"></i>Rate & Review
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Rate</label>
              <select name="rating" class="form-select shadow-none">
                <option value="5">Excellent</option>
                <option value="4">Good</option>
                <option value="3">Ok</option>
                <option value="2">Poor</option>
                <option value="1">Bad</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Review</label>
              <textarea type="text" name="review" required rows="3" class="form-control shadow-none"></textarea>
            </div>

            <input type="hidden" name="booking_id">
            <input type="hidden" name="room_id">


            <div class="text-end">
              <button type="submit" class="btn btn-dark custom-bg text-white  shadow-none ">SUBMIT</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>







  <?php
  if (isset($_GET['cancel_status'])) {
    alert("success", "Booking Cancelled ");
  } else if (isset($_GET['review_status'])) {
    alert("success", "Thank you for Rating & Review");
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

    let review_form = document.getElementById('review-form');


    function review_room(bid, rid) {
      review_form.elements['booking_id'].value = bid;
      review_form.elements['room_id'].value = rid;
    }

    review_form.addEventListener('submit',(e)=> {
      e.preventDefault();

      let data = new FormData;
      data.append('review_form', '');
      data.append('rating', review_form.elements['rating'].value);
      data.append('review', review_form.elements['review'].value);
      data.append('booking_id', review_form.elements['booking_id'].value);
      data.append('room_id', review_form.elements['room_id'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/review_room.php", true);
      xhr.onload = function () {


        if (this.responseText == 1) {
          alert("success", "Changes saved!");
          window.location.href = 'bookings.php?review_status=true';
        }
        else {
          var myModal = document.getElementById('reviewModal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          alert('error', 'Rating and Review Failed!');

        }

      };
      xhr.send(data);

    })



  </script>




  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>