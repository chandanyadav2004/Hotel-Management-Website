let feature_s_form = document.getElementById("feature_s_form");
let facilities_s_form = document.getElementById("facilities_s_form");
feature_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_feature();
});
facilities_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_facility();
});
function add_feature() {
  let form_data = new FormData();
  form_data.append("name", feature_s_form.elements["feature_name"].value);
  form_data.append("add_feature", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);

  xhr.onload = function () {
    // console.log(this.response);
    var myModal = document.getElementById("feature-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == 1) {
      alert("success", "Features added successfully");
      get_features();
      feature_s_form.elements["feature_name"].value = "";
    } else {
      alert("error", "Unable to add features");
    }
  };

  xhr.send(form_data);
}

function get_features() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    document.getElementById("features-data").innerHTML = this.responseText;
  };

  xhr.send("get_features");
}

function rem_feature(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    if (this.responseText == 1) {
      alert("success", "Feature deleted successfully");
      get_features();
    } else if (this.responseText == "rooms_added") {
      alert("error", "Unable to delete feature, it is already added in rooms");
    } else {
      alert("error", "Unable to delete feature");
    }
  };

  xhr.send("rem_feature=" + id);
}

function add_facility() {
  let form_data = new FormData();
  form_data.append("name", facilities_s_form.elements["facility_name"].value);
  form_data.append(
    "icon",
    facilities_s_form.elements["facility_icon"].files[0]
  );
  form_data.append("desc", facilities_s_form.elements["facility_desc"].value);
  form_data.append("add_facility", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);

  xhr.onload = function () {
    // console.log(this.response);
    var myModal = document.getElementById("facility-s");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == "inv_img") {
      alert("error", "Only svg image are allowed");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image size should be less than 2MB");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed");
    } else {
      alert("success", "New Facility added successfully");
      // get_members();
      get_facilities();
      facilities_s_form.reset();
    }
  };

  xhr.send(form_data);
}

function get_facilities() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    document.getElementById("facilities-data").innerHTML = this.responseText;
  };

  xhr.send("get_facilities");
}
function rem_facility(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // console.log(this.response);
    if (this.responseText == 1) {
      alert("success", "Facility deleted successfully");
      get_facilities();
    } else if (this.responseText == "rooms_added") {
      alert("error", "Unable to delete facility, it is already added in rooms");
    } else {
      alert("error", "Unable to delete facility");
    }
  };

  xhr.send("rem_facility=" + id);
}

window.onload = function () {
  get_features();
  get_facilities();
};
