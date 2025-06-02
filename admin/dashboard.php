<?php

require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
// session_start()



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - DashBoard</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">


                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3>DASHBOARD</h3>
                    <h6 class="badge bg-danger py-2 px-2 rounded">Shutdown Mode is Active!</h6>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="new_booking.php" class="text-decoration-none">
                            <div class="card text-center text-success p-3">
                                <h6>New Bookings</h6>
                                <h1 class="mt-2 mb-0">5</h1>
                            </div>
                        </a>

                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="refund_booking.php" class="text-decoration-none">
                            <div class="card text-center text-warning p-3">
                                <h6>Refund Bookings</h6>
                                <h1 class="mt-2 mb-0">5</h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>User Queries</h6>
                                <h1 class="mt-2 mb-0">5</h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="rate_review.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Rating & Reviews</h6>
                                <h1 class="mt-2 mb-0">5</h1>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5>Booking Analytics </h5>
                    <select name="" id="" class="form-select shadow-none bg-light w-auto">
                        <option value="1">Past 30 Days</option>
                        <option value="2">Past 90 Days</option>
                        <option value="3">Past 1 Years</option>
                        <option value="4">All time</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Totals Bookings</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                            <h4 class="mt-mb-0">₹0</h4>
                        </div>    
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Totals Bookings</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                            <h4 class="mt-mb-0">₹0</h4>
                        </div>    
                    </div>
                    

                    
                </div>

            </div>
        </div>
    </div>



    <?php require('inc/scripts.php') ?>
</body>

</html>