function get_booking(search="") {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/refund_booking.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("table-data").innerHTML = this.responseText;
  };
  xhr.send("get_booking=1&search="+search);
}



function refund_booking(id) {
  if (confirm("Refund money for  this Booking ?")) {
    let form_data = new FormData();
    form_data.append("booking_id", id);
    form_data.append("refund_booking", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refund_booking.php", true);
    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Refund Success  ");
        get_booking();
      } else {
        alert("error", "Refund Fails");
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
