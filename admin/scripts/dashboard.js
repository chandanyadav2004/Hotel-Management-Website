function booking_analytics(period=1) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/dashboard.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let data =JSON.parse(this.responseText);
    document.getElementById("table-data").innerHTML = data.table_data;
    document.getElementById("table-pagination").innerHTML = data.pagination;
  };
  xhr.send("get_booking&search="+search+"&page="+page);
}







window.onload = function () {
  get_booking();
};
