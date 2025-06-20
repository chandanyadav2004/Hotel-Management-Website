<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $setting_res['site_title'] ?></h3>
      <p>
        <?php echo $setting_res['site_about'] ?>

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
        echo <<<data
            
              <a href="$contact_res[tw]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-twitter me-1"></i>Twitter
                </span>
              </a>
              <br>
            
            data;
      }

      if ($contact_res['fb'] != '') {
        echo <<<data
            
              <a href="$contact_res[fb]" class="d-inline-block mb-3 ">
                <span class="badge fs-6 p-2 bg-light text-dark">
                  <i class="bi bi-facebook me-1"></i>Facebook
                </span>
              </a>
              <br>
            
            data;
      }
      if ($contact_res['insta'] != '') {
        echo <<<data
            
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
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type == "success") ? "alert-success" : "alert-danger";
    let element = document.createElement('div');
    element.innerHTML = `
                <div class="alert ${bs_class} alert-dismissible fade show " role="alert">
                    <strong class="me-3">${msg}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
    if (position == 'body') {
      document.body.appendChild(element);
      element.classList.add('custom-alert')
    } else {
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 2000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();
  }


  function setActive() {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
      // let current_url = window.location.href;
      let link_url = a_tags[i].href.split('/').pop();
      let file_name = link_url.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      } else {
        a_tags[i].classList.remove('active');
      }
    }
  }

  let register_form = document.getElementById('register-form');
  register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
      console.log('Server Response:', this.responseText);

      let res = this.responseText.trim();

      if (res == 'pass_mismatch') {
        alert('error', 'Password Is not Match with confirm password');
      } else if (res == 'invalid_image') {
        alert('error', 'Invalid Image Type: Only JPG, PNG, WEBP, JPEG allowed');
      } else if (res == 'Upd_Failed') {
        alert('error', 'Upload Failed');
      } else if (res == 'email_already') {
        alert('error', 'Email already registered');
      } else if (res == 'phone_already') {
        alert('error', 'Phone number already registered');
      } else if (res == 'mail_failed') {
        alert('error', 'Cannot send confirmation mail');
      } else if (res == 'ins_failed') {
        alert('error', 'Database insertion failed');
      } else if (res == '1') {
        alert('success', 'Registration successfully');
        register_form.reset();
      } else {
        alert('error', 'Unknown error: ' + res);
      }
    };

    xhr.send(data);

  });


  let login_form = document.getElementById('login-form');
  login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('pass', login_form.elements['pass'].value);
    data.append('login', '');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
      console.log('Server Response:', this.responseText);

      let res = this.responseText.trim();

      if (res == 'inv_email_mob') {
        alert('error', 'Invalid Mobile No and email');
      }
      else if (res == 'not_verified') {
        alert('error', 'Email Not Verified');
      }
       else if (res == 'inactive') {
        alert('error', 'Admin Blocked contact admin');
      } 
      else if (res == 'invalid_pass') {
        alert('error', 'Invalid Password');
      }
      else{
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php'){
          window.location = window.location.href;
        }
        else{
          window.location = window.location.pathname;
        }
      } 
    };

    xhr.send(data);

  });


  let forgot_form = document.getElementById('forgot-form');
  forgot_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email', forgot_form.elements['email'].value);
    data.append('forgot_pass', '');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
      // console.log('Server Response:', this.responseText);

      let res = this.responseText.trim();

      if (res == 'inv_email') {
        alert('error', 'Invalid  email');
      }
      else if (res == 'not_verified') {
        alert('error', 'Email Not Verified');
      }
       else if (res == 'inactive') {
        alert('error', 'Admin Blocked contact admin');
      } 
      else if (res == 'mail_failed') {
        alert('error', 'Mail Sent Failed');
      }
      else if (res == 'upd_failed') {
        alert('error', 'Update Failed');
      }
      else{
        alert('success', "Password updated successfully");
        forgot_form.reset();
      } 
    };

    xhr.send(data);

  });

 function checkLoginToBook(login,id){
  if(login){
    window.location.href='confirm_booking.php?id='+id;
  }
  else{
    alert('error',"Please login to book room!");
  }

 }

  setActive();


</script>