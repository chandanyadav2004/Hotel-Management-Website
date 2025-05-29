<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- ROOMS DETAILS</title>


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
  <?php

  if (!isset($_GET['id'])) {
    redirect('rooms.php');
  }

  $data = filteration($_GET);
  $room_res = select('SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `remove`=?', [$data['id'], 1, 0], 'iii');
  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);



  ?>





  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold "><?php echo $room_data['name'] ?> </h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>

        </div>
      </div>

      <div class="col-lg-7 col-md-12 px-4 ">
        <div id="roomCarousel" class="carousel slide">
          <div class="carousel-inner">
            <?php
            $room_img = ROOM_IMG_PATH . 'thumbnail.jpg';
            $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]'");

            if (mysqli_num_rows($img_q) > 0) {
              $active_class = 'active';
              while ($img_res = mysqli_fetch_assoc($img_q)) {
                echo "
                <div class='carousel-item $active_class'>
                  <img src='" . ROOM_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'>
                </div>
              ";
                $active_class = '';
              }
            } else {
              echo "
                <div class='carousel-item active'>
                  <img src=$room_img class='d-block w-100 rounded'>
                </div>
              ";
            }
            ?>

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class='card mb-4  border-0 shadow-sm rounded-3'>
          <div class="card-body">
            <?php

            echo <<<price
               <h4>₹$room_data[price] per night</h4>
              price;

            echo <<<rating
               <div class="rating">
                 <i class="bi bi-star-fill text-warning"></i>
                 <i class="bi bi-star-fill text-warning"></i>
                 <i class="bi bi-star-fill text-warning"></i>
                 <i class="bi bi-star-fill text-warning"></i>
                 <i class="bi bi-star-fill text-warning"></i>
               </div>
              rating;
            // Get room features
            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `rooms_features` rf ON f.id = rf.feature_id WHERE rf.room_id = '$room_data[id]'");
            $features_data = '';
            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
              $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$fea_row[name]</span>";
            }
            echo <<<feature
              <div class='features mb-3'>
                  <h6 class='mb-1'>Features</h6>
                  $features_data
                </div>

            feature;
            $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `rooms_facilities` rf ON f.id = rf.facilities_id WHERE rf.rooms_id = '$room_data[id]'");
            $facilities_data = '';
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
              $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1 '>$fac_row[name]</span>";
            }
            echo <<<facilities
              <div class='features mb-3'>
                  <h6 class='mb-1'>Features</h6>
                  $facilities_data
                </div>

            facilities;

            echo <<<guests
                <div class='guests mb-3'>
                  <h6 class='mb-1'>Guest</h6>
                  <span class='badge rounded-pill bg-light text-dark text-wrap lh-base'>$room_data[adult] Adult</span>
                  <span class='badge rounded-pill bg-light text-dark text-wrap lh-base'>$room_data[children] Children</span>
                </div>

            guests;

            echo<<<area
              <div class='features mb-3'>
                  <h6 class='mb-1'>Area</h6>
                  <span class='badge rounded-pill bg-light text-dark text-wrap lh-base me-1 mb-1'>$room_data[area] sq.ft.</span>
                  
                </div>
            area;

            echo<<<book
              <a href='#' class='btn  w-100 text-white custom-bg shadow-none mb-1'>Book Now</a>
            book;
           
            ?>
          </div>

        </div>

      </div>

      <div class="col-12 mt-5 px-4">
        <div class="mb-4">
          <h5>Description</h5>
          <p>
            <?php echo $room_data['description'] ?>
          </p>
        </div>
        <div class="review-rating">
          <h5 class="mb-3">Reviews & Rating</h5>
          <div>
            <div class=" d-flex align-items-center mb-2">
            <img src="images/facilities/IMG_47816.svg" width="30px">
            <h6 class="m-0 ms-2 ">Random user1</h6>
          </div>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Animi, autem qui voluptas nemo inventore sapiente.
            Ipsum blanditiis laudantium reiciendis quibusdam!
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
          </div>
        </div>
      </div>




    </div>
  </div>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>
  <!-- End Footer Section -->



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>