


function get_users() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("get_users");
}



function toggle_status(id, status) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Status toggled");
      get_users();
    } else {
      alert("error", "Unable to update Room status");
    }
  };
  xhr.send("toggle_status=" + id + "&status=" + status);
}



function remove_user(id) {
  if (confirm("Are you sure you want to remove this user ?")) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Users deleted successfully");
        get_users();
      } else {
        alert("error", "Unable to delete Users");
      }
    };
    xhr.send("remove_user=" + id);
  }
}

function search_user(username){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("search_user=true&name=" + encodeURIComponent(username));
}




window.onload = function () {
  get_users();
};
