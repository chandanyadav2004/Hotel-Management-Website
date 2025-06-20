<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?> - Facilities </title>

  
  <style>
    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }
    .pop:hover{
      border-top-color: var(--teal) !important;
      transform: scale(1.05);
      transition: all 0.3s;
    }
  </style>
</head>

<body class="bg-light">
<!-- Header Design -->
<?php require('include/header.php'); ?>
<!-- End of Header Design -->

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Lorem ipsum dolor sit amet consectetur, 
    adipisicing elit. <br> Provident sapiente molestias 
    fugit accusantium incidunt nulla vero inventore eum neque dolore.

  </p>
</div>

<div class="container">
  <div class="row">
    <?php 
      $res = selectAll("facilities");
      $path= FACILITIES_IMG_PATH;
      while($row = mysqli_fetch_assoc($res)){
        echo<<<data
          <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
              <div class="d-flex align-items-center mb-2">
                <img src="$path$row[icon]" width="40px">
                <h5 class="m-0 ms-3">$row[name]</h5>
              </div>
              
              <p>$row[description]</p>
            </div>
          </div>


        data;
      }    
    
    ?>

  </div>
</div>



<!-- Footer Section -->
<?php require('include/footer.php'); ?>
<!-- End Footer Section -->

    

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
</body>

</html>