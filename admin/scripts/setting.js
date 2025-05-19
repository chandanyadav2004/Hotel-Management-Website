let general_data, contacts_data;
let site_title_inp = document.getElementById("siteTitleInp");
let site_about_inp = document.getElementById("siteAboutInp");

let general_s_form = document.getElementById("general_s_form");
general_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_general(site_title_inp.value, site_about_inp.value);
});

let contact_s_form = document.getElementById("contact_s_form");
contact_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_contacts();
});

let team_s_form = document.getElementById("team_s_form");
let member_name_inp = document.getElementById("member_name_inp");
let member_picture_inp = document.getElementById("member_picture_inp");

function get_general() {
  let site_title = document.getElementById("siteTitle");
  let site_about = document.getElementById("siteAbout");

  let shutdown_toggle = document.getElementById("shutdown-toggle");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    general_data = JSON.parse(this.response);

    site_title.innerHTML = general_data.site_title;
    site_about.innerHTML = general_data.site_about;
    site_title_inp.value = general_data.site_title;
    site_about_inp.value = general_data.site_about;

    if (general_data.shutdown == 0) {
      shutdown_toggle.checked = false;
      shutdown_toggle.value = 0;
    } else {
      shutdown_toggle.checked = true;
      shutdown_toggle.value = 1;
    }

    // console.log(general_data);
  };

  xhr.send("get_general");
}

function get_contacts() {
  let contacts_p_id = [
    "address",
    "gmap",
    "pn1",
    "pn2",
    "email",
    "fb",
    "insta",
    "tw",
  ];
  let iframe = document.getElementById("iframe");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // general_data = JSON.parse(this.response);
    contacts_data = JSON.parse(this.response);
    // console.log(contacts_data);
    contacts_data = Object.values(contacts_data);
    // console.log(contacts_data);
    for (let i = 0; i < contacts_p_id.length; i++) {
      document.getElementById(contacts_p_id[i]).innerText =
        contacts_data[i + 1];
    }
    iframe.src = contacts_data[9];
    contacts_inp(contacts_data);
  };

  xhr.send("get_contacts");
}

function contacts_inp(contacts_data) {
  let contacts_p_id_input = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "insta_inp",
    "tw_inp",
    "iframe_inp",
  ];
  for (let i = 0; i < contacts_p_id_input.length; i++) {
    document.getElementById(contacts_p_id_input[i]).value =
      contacts_data[i + 1];
  }
}

function upd_general(site_title, site_about) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    var myModal = document.getElementById("general-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.response == 1) {
      get_general();
      alert("success", "Updated successfully");
    } else {
      alert("error", "Not Updated successfully");
    }
  };

  xhr.send(
    "site_title=" + site_title + "&site_about=" + site_about + "&upd_general"
  );
}

function upd_shutdown(value) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1 && general_data.shutdown == 0) {
      alert("success", "Site has been shutdown successfully");
    } else {
      alert("success", "Site has been not  shutdown  successfully");
    }
    get_general();
  };

  xhr.send("upd_shutdown=" + value);
}

function upd_contacts() {
  let index = [
    "address",
    "gmap",
    "pn1",
    "pn2",
    "email",
    "fb",
    "insta",
    "tw",
    "iframe",
  ];
  let contacts_inp_id = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "insta_inp",
    "tw_inp",
    "iframe_inp",
  ];
  let data_str = "";
  for (let i = 0; i < contacts_inp_id.length; i++) {
    data_str +=
      index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + "&";
  }
  data_str += "upd_contacts";
  // console.log(data_str);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    var myModal = document.getElementById("contact-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.response == 1) {
      get_contacts();
      alert("success", "Updated successfully");
    } else {
      alert("error", "Not Updated successfully");
    }
  };
  xhr.send(data_str);
}

team_s_form.addEventListener("submit", function (e) {
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
