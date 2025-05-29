<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- ROOMS </title>


  <style>
    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }
  </style>
</head>

<body class="bg-light">
  <!-- Header Design -->
  <?php require('include/header.php'); ?>
  <!-- End of Header Design -->

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR ROOMS </h2>
    <div class="h-line bg-dark"></div>

  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 ps-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">FILITERS</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
              data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterDropdown">
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">CHECK AVAILIABILITY</h5>
                <label class="form-label">Check-In</label>
                <input type="date" class="form-control shadow-none mb-3">
                <label class="form-label">Check-Out</label>
                <input type="date" class="form-control shadow-none">
              </div>

              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">FACILITIES</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f1">Facility one</label>

                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f2">Facility Two</label>

                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f3">Facility Three</label>

                </div>

              </div>

              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">GUESTS</h5>
                <div class="d-flex">
                  <div class="me-2">
                    <label class="form-label">Adults</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label">Childern</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                </div>

              </div>


            </div>
          </div>
        </nav>
      </div>

      <div class="col-lg-9 col-md-12 px-4">
        <?php
        $room_res = select('SELECT * FROM `rooms` WHERE `status`=? AND `remove`=?', [1, 0], 'ii');

        while ($room_data = mysqli_fetch_assoc($room_res)) {
          // Get room features
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `rooms_features` rf ON f.id = rf.feature_id WHERE rf.room_id = '$room_data[id]'");
          $features_data = '';
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$fea_row[name]</span>";
          }
          // Get room facilities
          $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `rooms_facilities` rf ON f.id = rf.facilities_id WHERE rf.rooms_id = '$room_data[id]'");
          $facilities_data = '';
          while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$fac_row[name]</span>";
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
            $book_btn = "<a href='#' class='btn btn-sm w-100 text-white mb-2 custom-bg shadow-none'>Book Now</a>";
          }
          // Print room card
          echo "
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


        }



        ?>





      </div>



    </div>
  </div>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>
  <!-- End Footer Section -->



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>