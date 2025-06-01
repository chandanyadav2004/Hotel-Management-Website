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
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:16px;">
                  <span>CHECK AVAILIABILITY</span>
                  <button id="chk_avail_btn" onclick="chk_avail_clear()"
                    class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
                </h5>
                <label class="form-label">Check-In</label>
                <input type="date" class="form-control shadow-none mb-3" id="checkin" onchange="chk_avail_filter()">
                <label class="form-label">Check-Out</label>
                <input type="date" class="form-control shadow-none" id="checkout" onchange="chk_avail_filter()">
              </div>


              <!-- Facilitites  -->

              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:16px;">
                  <span>FACILITITES</span>
                  <button id="facilities_btn" onclick="facilities_clear()"
                    class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
                </h5>
                <?php

                $facilities_q = selectAll('facilities');
                while ($row = mysqli_fetch_assoc($facilities_q)) {
                  echo <<<facilities
                      <div class="mb-2">
                        <input type="checkbox" onclick="fetch_rooms()" value="$row[id]" id="$row[id]" name="facilities" class="form-check-input shadow-none me-1">
                        <label class="form-label" for="$row[id]">$row[name]</label>
                      </div>

                    facilities;
                }

                ?>

              </div>

              <!-- Guests -->

              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:16px;">
                  <span>GUESTS</span>
                  <button id="guests_btn" onclick="guests_clear()"
                    class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
                </h5>
                <div class="d-flex">
                  <div class="me-2">
                    <label class="form-label">Adults</label>
                    <input type="number" min="1" id="adults" oninput="guests_filter()" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label">Childern</label>
                    <input type="number" max="1" id="children" oninput="guests_filter()"
                      class="form-control shadow-none">
                  </div>
                </div>

              </div>


            </div>
          </div>
        </nav>
      </div>

      <div class="col-lg-9 col-md-12 px-4" id="rooms-data">








      </div>



    </div>
  </div>



  <!-- Footer Section -->
  <?php require('include/footer.php'); ?>
  <!-- End Footer Section -->

  <script>

    let rooms_data = document.getElementById('rooms-data');
    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let chk_avail_btn = document.getElementById('chk_avail_btn');

    let adults = document.getElementById('adults');
    let children = document.getElementById('children');
    let guests_btn = document.getElementById('guests_btn');

    let facilities_btn = document.getElementById('facilities_btn');



    function fetch_rooms() {
      let chk_avail = JSON.stringify({
        checkin: checkin.value,
        checkout: checkout.value
      });

      let guests = JSON.stringify({
        adults: adults.value,
        children: children.value
      });

      let facilities_list = { "facilities": [] };
      let get_facilities = document.querySelectorAll("[name='facilities']:checked");
      if (get_facilities.length > 0) {
        get_facilities.forEach((facility) => {
          facilities_list.facilities.push(facility.value);

        });
        facilities_btn.classList.remove('d-none');
      }
      else {
        facilities_btn.classList.add('d-none');
      }

      facility_list = JSON.stringify(facilities_list);



      let xhr = new XMLHttpRequest();
      xhr.open("GET", "ajax/rooms.php?fetch_rooms&chk_aval=" + chk_avail + "&guests=" + guests + "&facility_list=" + facility_list, true);
      xhr.onprogress = function () {
        rooms_data.innerHTML = `<div class="spinner-border text-info mb-3 mx-auto d-block" id="loader" role="status">
          <span class="visually-hidden">Loading..</span>
        </div>`;

      }

      xhr.onload = function () {

        rooms_data.innerHTML = this.responseText;
      }
      xhr.send();
    }

    function chk_avail_filter() {
      if (checkin.value != '' && checkout.value != '') {
        fetch_rooms();
        chk_avail_btn.classList.remove('d-none');
      }

    }

    function chk_avail_clear() {
      checkin.value = '';
      checkout.value = '';
      chk_avail_btn.classList.add('d-none');
      fetch_rooms();
    }

    function guests_filter() {
      if (adults.value > 0 || children.value > 0) {
        fetch_rooms();
        guests_btn.classList.remove('d-none');
      }
    }


    function facilities_clear() {
      let get_facilities = document.querySelectorAll("[name='facilities']:checked");
      get_facilities.forEach((facility) => {
        facility.checked=false;

      });
      facilities_btn.classList.add('d-none');
      fetch_rooms();
    }


    fetch_rooms();

  </script>



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>