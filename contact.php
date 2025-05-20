<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Management Website - CONTACT </title>
  <?php require('include/links.php'); ?>


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
    <h2 class="fw-bold h-font text-center">CONTACT US </h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor sit amet consectetur,
      adipisicing elit. <br> Provident sapiente molestias
      fugit accusantium incidunt nulla vero inventore eum neque dolore.

    </p>
  </div>

  <?php
  $contact_q = "SELECT * FROM `contact_details` where `sr_no`=?";
  $values = [1];
  $contact_res = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
  // print_r($contact_res);
  ?>




  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4 ">
          <iframe class="w-100 rounded MB-4" height="220px"
            src="<?php echo $contact_res['iframe'] ?>"
            loading="lazy"></iframe>
          <H5>Address</H5>
          <a href="<?php echo $contact_res['gmap'] ?>" target="_blank"
            class="d-inline-block text-decoration-none text-dark mb-2">
            <i class="bi bi-geo-alt-fill"></i><?php echo $contact_res['address'] ?>
          </a>
          <h5 class="mt-3">Call us</h5>
          <a href="tel: +<?php echo $contact_res['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark ">
            <i class="bi bi-telephone-fill"></i>+<?php echo $contact_res['pn1'] ?>
          </a>
          <br>
          <?php
          if ($contact_res['pn2'] != '') {
            echo<<<data
            
              <a href="tel: +$contact_res[pn2]" class="d-inline-block  text-decoration-none text-dark ">
                <i class="bi bi-telephone-fill"></i>+$contact_res[pn2]
              </a>
            
            data;
          }
          
          ?>
          <h5 class="mt-3">Email us</h5>
          <a href="mailto: <?php echo $contact_res['email'] ?>" class="d-inline-block  text-decoration-none text-dark ">
            <i class="bi bi-envelope-fill"></i><?php echo $contact_res['email'] ?></a>


          <h5 class="mt-3">Follow us</h5>
          <?php
          if ($contact_res['tw'] != '') {
            echo<<<data
            
              <a href="$contact_res[tw]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-twitter me-1"></i>
                </span>
              </a>
             
            
            data;
          }

          if ($contact_res['fb'] != '') {
            echo<<<data
            
              <a href="$contact_res[fb]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-facebook me-1"></i>
                </span>
              </a>
             
            
            data;
          }
          if ($contact_res['insta'] != '') {
            echo<<<data
            
              <a href="$contact_res[insta]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-instagram me-1"></i>
                </span>
              </a>
           
            
            data;
          }
          
          ?>

        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4 ">
          <form method="POST">
            <h5>Send a message</h5>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Name</label>
              <input type="text" name="name" required class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Email</label>
              <input type="email" name="email" required class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Subject</label>
              <input type="text" name="subject" required class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Message</label>
              <textarea rows="6"name="message" required class="form-control shadow-none" style="resize:none;"></textarea>
            </div>
            <div class="mt-3">
              <button type="submit" name="send" class="btn text-white custom-bg shadow-none">Send Message</button>
          </form>
        </div>
      </div>



    </div>
  </div>

  <?php
    if (isset($_POST['send'])) {
      $frm_data = filteration($_POST);
      $q = "INSERT INTO `user_queries`( `name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
      $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
      $res = insert($q, $values, 'ssss');
      if ($res==1) {
        alert('success', 'Message sent successfully');
      } else {
        alert('error', 'Unable to send message');
      }
    }

  ?>

  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>
  <!-- End Footer Section -->



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>