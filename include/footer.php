


<div class="container-fluid bg-white mt-5">
      <div class="row">
        <div class="col-lg-4 p-4">
          <h3 class="h-font fw-bold fs-3 mb-2">Chandan Hotel</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assumenda repellat beatae sapiente perspiciatis aut omnis quae? Molestiae minima nisi vero.
          </p>
        </div>
        <div class="col-lg-4 p-4">
          <h5 class="mb-3">Links</h5>
          <a href="index.php" class="d-inline-block mb-3 text-dark text-decoration-none">Home</a><br>
          <a href="rooms.php" class="d-inline-block mb-3 text-dark text-decoration-none">Rooms</a><br>
          <a href="facilities.php" class="d-inline-block mb-3 text-dark text-decoration-none">Facilities</a><br>
          <a href="contact.php" class="d-inline-block mb-3 text-dark text-decoration-none">Contact us</a><br>
          <a href="about.php" class="d-inline-block mb-3 text-dark text-decoration-none">About</a><br>
        </div>
        <div class="col-lg-4 p-4">
          <h5 class="mb-3">Follow us</h5>
          <?php
          if ($contact_res['tw'] != '') {
            echo<<<data
            
              <a href="$contact_res[tw]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-twitter me-1"></i>Twitter
                </span>
              </a>
              <br>
            
            data;
          }

          if ($contact_res['fb'] != '') {
            echo<<<data
            
              <a href="$contact_res[fb]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-facebook me-1"></i>Facebook
                </span>
              </a>
              <br>
            
            data;
          }
          if ($contact_res['insta'] != '') {
            echo<<<data
            
              <a href="$contact_res[insta]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-instagram me-1"></i>Instagram
                </span>
              </a>
              <br>
            
            data;
          }
          
          ?>
        </div>
      </div>
    </div>

    <h6 class="text-center bg-dark  text-white p-3 m-0 ">Designed and Developed by Chandan WEBDEV</h6>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

<script>
  function setActive() {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
      // let current_url = window.location.href;
      let link_url = a_tags[i].href.split('/').pop();
      let file_name = link_url.split('.')[0];

      if (document.location.href.indexOf(file_name) >=0) {
        a_tags[i].classList.add('active');
      } else {
        a_tags[i].classList.remove('active');
      }
    }       
  }
  window.onload = setActive;
</script>