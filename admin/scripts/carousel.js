

let carousel_s_form = document.getElementById("carousel_s_form");
let member_name_inp = document.getElementById("member_name_inp");
let member_picture_inp = document.getElementById("member_picture_inp");


carousel_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_member();
});

function add_member() {
  let form_data = new FormData();
  form_data.append("name", member_name_inp.value);
  let picture = member_picture_inp.files[0];
  form_data.append("picture", picture);
  form_data.append("add_member", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);

  xhr.onload = function () {
    // console.log(this.response);
    var myModal = document.getElementById("team-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == "inv_img") {
      alert("error", "Only jpg, png and webp image are allowed");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image size should be less than 2MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else {
      alert("success", "Member added successfully");
      member_name_inp.value = "";
      member_picture_inp.value = "";
      get_members();
    }
  };

  xhr.send(form_data);
}

function get_members() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    document.getElementById("team-data").innerHTML = this.responseText;
  };

  xhr.send("get_members");
}

function rem_member(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    if (this.responseText == 1) {
      alert("success", "Member deleted successfully");
      get_members();
    } else {
      alert("error", "Member not deleted successfully");
    }
  };

  xhr.send("rem_member=" + id);
}

window.onload = function () {
  get_general();
  get_contacts();
  get_members();
};
