function booking_analytics(period=1) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/dashboard.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let data =JSON.parse(this.responseText);
    console.log(data);
    
    document.getElementById("total_booking").textContent = data.total_booking;
    document.getElementById("total_amt").textContent = "₹"+data.total_amt;
    document.getElementById("active_bookings").textContent = data.active_bookings;
    document.getElementById("active_amt").textContent = "₹"+data.active_amt;
    document.getElementById("cancelled_bookings").textContent = data.cancelled_bookings;
    document.getElementById("cancelled_amt").textContent = "₹"+data.cancelled_amt;
  };
  xhr.send("booking_analytics&period="+period);
}

function user_analytics(period=1) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/dashboard.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let data =JSON.parse(this.responseText);
    console.log(data);
    
    document.getElementById("total_queries").textContent = data.total_queries;
    document.getElementById("total_reviews").textContent = data.total_reviews;
    document.getElementById("total_new_reg").textContent = data.total_new_reg;
  };
  xhr.send("user_analytics&period="+period);
}







window.onload = function () {
  booking_analytics();
  user_analytics();
};
