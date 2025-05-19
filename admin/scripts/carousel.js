

let carousel_s_form = document.getElementById("carousel_s_form");
let carousel_picture_inp = document.getElementById("carousel_picture_inp");


carousel_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_image();
});

function add_image() {
  let form_data = new FormData();
  let picture = carousel_picture_inp.files[0];
  form_data.append("picture", picture);
  form_data.append("add_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/carousel_crud.php", true);

  xhr.onload = function () {
    // console.log(this.response);
    var myModal = document.getElementById("carousel-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == "inv_img") {
      alert("error", "Only jpg, png and webp image are allowed");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image size should be less than 2MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else {
      alert("success", "Image added successfully");
      carousel_picture_inp.value = "";
      get_carousel();
    }
  };

  xhr.send(form_data);
}

function get_carousel() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    document.getElementById("carousel-data").innerHTML = this.responseText;
  };

  xhr.send("get_carousel");
}

function rem_member(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    if (this.responseText == 1) {
      alert("success", "Member deleted successfully");
      get_carousel();
    } else {
      alert("error", "Member not deleted successfully");
    }
  };

  xhr.send("rem_member=" + id);
}

window.onload = function () {
  get_carousel();
};
