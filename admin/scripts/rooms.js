let add_room_form = document.getElementById("add_room_form");
// console.log(add_room_form);
add_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_room();
});

function add_room() {
  let form_data = new FormData();
  form_data.append("add_room", "");
  form_data.append("name", add_room_form.elements["name"].value);
  form_data.append("area", add_room_form.elements["area"].value);
  form_data.append("price", add_room_form.elements["price"].value);
  form_data.append("quantity", add_room_form.elements["quantity"].value);
  form_data.append("adult", add_room_form.elements["adult"].value);
  form_data.append("children", add_room_form.elements["children"].value);
  form_data.append("description", add_room_form.elements["description"].value);

  let features = [];

  add_room_form.elements["features"].forEach((el) => {
    if (el.checked) {
      features.push(el.value);
    }
  });
  let facilities = [];

  add_room_form.elements["facilities"].forEach((el) => {
    if (el.checked) {
      facilities.push(el.value);
    }
  });

  form_data.append("features", JSON.stringify(features));
  form_data.append("facilities", JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var myModal = document.getElementById("add-room");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == 1) {
      alert("success", "New Room added successfully");
      add_room_form.reset();
      get_all_rooms();
    } else {
      alert("error", "Unable to add Room");
    }
  };

  xhr.send(form_data);
}

function get_all_rooms() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("room-data").innerHTML = this.responseText;
  };
  xhr.send("get_all_rooms");
}

let edit_room_form = document.getElementById("edit_room_form");
// // console.log(add_room_form);
edit_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_room();
});

function edit_details(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    let data = JSON.parse(this.responseText);
    // console.log(data);
    edit_room_form.elements["name"].value = data.room.name;
    edit_room_form.elements["area"].value = data.room.area;
    edit_room_form.elements["price"].value = data.room.price;
    edit_room_form.elements["quantity"].value = data.room.quantity;
    edit_room_form.elements["adult"].value = data.room.adult;
    edit_room_form.elements["children"].value = data.room.children;
    edit_room_form.elements["description"].value = data.room.description;

    edit_room_form.elements["room_id"].value = data.room.id;

    edit_room_form.elements["facilities"].forEach((el) => {
      if (data.facilities.includes(Number(el.value))) {
        el.checked = true;
      }
    });
    edit_room_form.elements["features"].forEach((el) => {
      if (data.features.includes(Number(el.value))) {
        el.checked = true;
      }
    });
  };

  xhr.send("get_room=" + id);
}

function submit_edit_room() {
  let form_data = new FormData();
  form_data.append("edit_room", "");
  form_data.append("room_id", edit_room_form.elements["room_id"].value);
  form_data.append("name", edit_room_form.elements["name"].value);
  form_data.append("area", edit_room_form.elements["area"].value);
  form_data.append("price", edit_room_form.elements["price"].value);
  form_data.append("quantity", edit_room_form.elements["quantity"].value);
  form_data.append("adult", edit_room_form.elements["adult"].value);
  form_data.append("children", edit_room_form.elements["children"].value);
  form_data.append("description", edit_room_form.elements["description"].value);

  let features = [];

  edit_room_form.elements["features"].forEach((el) => {
    if (el.checked) {
      features.push(el.value);
    }
  });
  let facilities = [];

  edit_room_form.elements["facilities"].forEach((el) => {
    if (el.checked) {
      facilities.push(el.value);
    }
  });

  form_data.append("features", JSON.stringify(features));
  form_data.append("facilities", JSON.stringify(facilities));

  console.log(form_data.get("room_id"));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var myModal = document.getElementById("edit-room");
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); // Hide the modal
    if (this.responseText == 1) {
      alert("success", "New Room added successfully");
      edit_room_form.reset();
      get_all_rooms();
    } else {
      alert("error", "Unable to add Room");
    }
  };

  xhr.send(form_data);
}

function toggle_status(id, status) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Room status updated successfully");
      get_all_rooms();
    } else {
      alert("error", "Unable to update Room status");
    }
  };
  xhr.send("toggle_status=" + id + "&status=" + status);
}

let add_image_form = document.getElementById("add_image_form");
add_image_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_image();
});

function add_image() {
  // let alert_div = document.getElementById("image-alert");
  let form_data = new FormData();
  form_data.append("add_image", "");
  form_data.append("image", add_image_form.elements["image"].files[0]);
  form_data.append("room_id", add_image_form.elements["room_id"].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  xhr.onload = function () {
    if (this.responseText == "inv_img") {
      alert(
        "error",
        "Invalid image format. Please upload a jpg, jpeg, png, or webp image.",
        "image-alert"
      );
    } else if (this.responseText == "inv_size") {
      alert("error", "Image size exceeds the limit of 2MB.", "image-alert");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed . Server Down.", "image-alert");
    } else {
      alert("success", "Image added successfully", "image-alert");
      room_images(
        add_image_form.elements["room_id"].value,
        document.querySelector("#room-images .modal-title").innerText
      );
      add_image_form.reset();
      // get_room_images(add_image_form.elements["room_id"].value);
    }
  };
  xhr.send(form_data);
}

function room_images(id, name) {
  document.querySelector("#room-images .modal-title").innerText = name;
  add_image_form.elements["room_id"].value = id;
  add_image_form.elements["image"].value = "";

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("room-image-data").innerHTML = this.responseText;
  };

  xhr.send("get_room_images=" + id);
}

function rem_image(id, room_id) {
  let form_data = new FormData();
  form_data.append("image_id", id);
  form_data.append("room_id", room_id);
  form_data.append("rem_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Image removed successfully", "image-alert");
      room_images(
        room_id,
        document.querySelector("#room-images .modal-title").innerText
      );
    } else {
      alert("error", "Unable to remove image", "image-alert");
    }
  };
  xhr.send(form_data);
}

function thumb_image(id, room_id) {
  let form_data = new FormData();
  form_data.append("image_id", id);
  form_data.append("room_id", room_id);
  form_data.append("thumb_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room.php", true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Image Thumbnail Changed successfully", "image-alert");
      room_images(
        room_id,
        document.querySelector("#room-images .modal-title").innerText
      );
    } else {
      alert("error", "Unable to Changed Thumbnail image", "image-alert");
    }
  };
  xhr.send(form_data);
}

function remove_room(id) {
  if (confirm("Are you sure you want to delete this room?")) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/room.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Room deleted successfully");
        get_all_rooms();
      } else {
        alert("error", "Unable to delete Room");
      }
    };
    xhr.send("remove_room=" + id);
  }
}

window.onload = function () {
  get_all_rooms();
};
