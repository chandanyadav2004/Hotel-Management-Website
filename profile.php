<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('include/links.php'); ?>
  <title><?php echo $setting_res['site_title']; ?>- PROFILE</title>
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

  $u_exist = select("SELECT * FROM `users_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');

  if (mysqli_num_rows($u_exist) == 0) {
    redirect('index.php');
  }

  $u_exist_fetch = mysqli_fetch_assoc($u_exist);


  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold "> PROFILE </h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="bookings.php" class="text-secondary text-decoration-none">PROFILE</a>
        </div>
      </div>


      <div class="col-12 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="info-form">
            <h5 class="mb-3 fw-bold">Basic Information</h5>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Name </label>
                <input name="name" type="text" value="<?php echo $u_exist_fetch['name']; ?>"
                  class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Phone Number </label>
                <input name="phonenum" type="text" value="<?php echo $u_exist_fetch['phonenum']; ?>"
                  class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Date of birth</label>
                <input name="dob" type="date" value="<?php echo $u_exist_fetch['dob']; ?>"
                  class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Pincode </label>
                <input name="pincode" type="number" value="<?php echo $u_exist_fetch['pincode']; ?>"
                  class="form-control shadow-none" required>
              </div>
              <div class="col-md-8 mb-4">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none"
                  rows="1"><?php echo $u_exist_fetch['address']; ?></textarea>
              </div>
            </div>
            <button type="submit" class="btn text-white custom-bg  shadow-none ">Save Changes</button>

          </form>
        </div>

      </div>

      <div class="col-md-4 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="profile-form">
            <h5 class="mb-3 fw-bold">Picture Information</h5>
            <img src="<?php echo USERS_IMG_PATH . $u_exist_fetch['profile'] ?>" class="rounded-circle img-fluid"><br>

            <label class="form-label">New Picture</label>
            <input name="profile" type="file" class="form-control shadow-none mb-3" accept=".jpg,.png,.jpeg,.webp"
              required>
            <button type="submit" class="btn text-white custom-bg  shadow-none ">Save Changes</button>

          </form>
        </div>

      </div>





    </div>
  </div>


  <?php
  if (isset($_GET['cancel_status'])) {
    alert("success", "Booking Cancelled ");
  }

  ?>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>

  <script>

    let info_form = document.getElementById('info-form');
    info_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData;
      data.append('info_form', '');
      data.append('name', info_form.elements['name'].value);
      data.append('phonenum', info_form.elements['phonenum'].value);
      data.append('pincode', info_form.elements['pincode'].value);
      data.append('address', info_form.elements['address'].value);
      data.append('dob', info_form.elements['dob'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/profile.php", true);
      xhr.onload = function () {


        if (this.responseText == 'phone_already') {
          alert('error', 'Phone number already registered');
        }
        else if (this.responseText == 0) {
          alert('error', 'No Changes');
        }
        else {
          alert("success", "Changes saved!");
          window.location.href = window.location.pathname;

        }
      };
      xhr.send(data);

    })


    let profile_form = document.getElementById('profile-form');
    profile_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData;
      data.append('profile_form', '');
      data.append('profile', profile_form.elements['profile'].files[0]);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/profile.php", true);
      xhr.onload = function () {

        let res = this.responseText;

        if (res == 'invalid_image') {
          alert('error', 'Invalid Image Type: Only JPG, PNG, WEBP, JPEG allowed');
        } else if (res == 'Upd_Failed') {
          alert('error', 'Upload Failed');
        }else if (this.responseText == 0) {
          alert('error', 'No Changes');
        }else{
          window.location.href = window.location.pathname;

        }
      }
        xhr.send(data);

      })




  </script>




  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>