function get_booking(search="") {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_booking.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("table-data").innerHTML = this.responseText;
  };
  xhr.send("get_booking=1&search="+search);
}

let assign_room_form = document.getElementById("assign_room_form");
assign_room_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let form_data = new FormData();
  form_data.append("room_no", assign_room_form.elements["room_no"].value);
  form_data.append("booking_id", assign_room_form.elements["booking_id"].value);
  form_data.append("assign_room", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_booking.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById("assign-room");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert("success", "Room Number Alloted! Booking Finalized");
      assign_room_form.reset();
      get_booking();
    } else {
      alert("error", "Server Down");
    }
  };

  xhr.send(form_data);
});

function assign_room(id) {
  assign_room_form.elements["booking_id"].value = id;
}

function cancel_booking(id) {
  if (confirm("Are you sure you want to Cancel  this Booking ?")) {
    let form_data = new FormData();
    form_data.append("booking_id", id);
    form_data.append("cancel_booking", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_booking.php", true);
    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Booking Cancelled ");
        get_booking();
      } else {
        alert("error", "server down");
      }
    };
    xhr.send(form_data);
  }
}



function search_user(username) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("search_user&name=" + username);
}

window.onload = function () {
  get_booking();
};
