<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Management Website - About </title>
  <?php require('include/links.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    .box {
      border-top-color: var(--teal) !important;
    }
  </style>

  
  
</head>

<body class="bg-light">
<!-- Header Design -->
<?php require('include/header.php'); ?>
<!-- End of Header Design -->

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">ABOUT US </h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Lorem ipsum dolor sit amet consectetur, 
    adipisicing elit. <br> Provident sapiente molestias 
    fugit accusantium incidunt nulla vero inventore eum neque dolore.

  </p>
</div>

<div class="container">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2 ">
      <h3 class="mb-3">Lorem ipsum dolor sit</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Excepturi est natus, facere earum voluptates enim consequatur.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Excepturi est natus, facere earum voluptates enim consequatur.
      </p>
    </div>
    <div class="col-lg-5 col-md-4 mb-4 order-lg-2 order-md-2 order-1">
      <img src="images/about/about.jpg" class="w-100" >
    </div>
  </div>
</div>


<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white shadow rounded p-4 text-center border-top border-4 box">
        <img src="images/about/hotel.svg" width="70px">
        <h4 class="mt-3">100+ ROOMS</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white shadow rounded p-4 text-center border-top border-4 box">
        <img src="images/about/customers.svg" width="70px">
        <h4 class="mt-3">200+ CUSTOMER</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white shadow rounded p-4 text-center border-top border-4 box">
        <img src="images/about/rating.svg" width="70px">
        <h4 class="mt-3">150+ REVIEWS</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white shadow rounded p-4 text-center border-top border-4 box">
        <img src="images/about/staff.svg" width="70px">
        <h4 class="mt-3">200+ STAFF</h4>
      </div>
    </div>

  </div>
</div>

<h3 class="my-5 fw-bold h-font text-center ">MANAGEMENT TEAM</h3>

<div class="container px-4">
    <div class="swiper mySwiper ">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 1</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 2</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 3</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 4</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 5</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 6</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 7</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 8</h5>
        </div>
        <div class="swiper-slide bg-white rounded text-center overflow-hidden">
          <img src="images/about/team.jpg" class="w-100">
          <h5 class="mt-2">Random Name 9 </h5>
        </div>

      </div>
      <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Footer Section -->
<?php require('include/footer.php'); ?>
<!-- End Footer Section -->

    

<!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
          320: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 3,
          },
        }
    });
  </script>


</body>

</html>