<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Management Website - Facilities </title>
  <?php require('include/links.php'); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  
  <style>
    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }
    .availability-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }

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
</div>

<!-- Footer Section -->
<?php require('include/footer.php'); ?>
<!-- End Footer Section -->

    

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
</body>

</html>