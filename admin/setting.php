<?php

require('inc/essentials.php');
adminLogin();
// session_start()



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Setting</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTING</h3>

                <!-- General Setting section -->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#general-s">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold ">Side Title</h6>
                        <p class="card-text" id="siteTitle"></p>
                        <h6 class="card-subtitle mb-1 fw-bold ">About Us</h6>
                        <p class="card-text" id="siteAbout"></p>
                    </div>
                </div>

                <!-- General Setting section Modal -->
                <div class="modal fade" id="general-s"  >
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Setting</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" id="siteTitleInp" name="site_title"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site About Us </label>
                                        <textarea rows="6" id="siteAboutInp" name="site_about"
                                            class="form-control shadow-none" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        onclick="site_title.value=general_data.site_title , site_about.value=general_data.site_about"
                                        class="btn shadow-none text-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ShutDown section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">ShutDown Website</h5>
                            <div class="form-check form-switch">
                                <form action="">
                                    <input onclick="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                                        id="shutdown-toggle">

                                </form>
                            </div>
                        </div>

                        <p class="card-text">
                            No customer will be allowed to book hotel room , when the website is shut down on.
                        </p>
                    </div>
                </div>

                <!-- Contact us details  section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#contact-s">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold ">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold ">Google map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text  mb-1"><i class="bi bi-telephone-fill"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text"><i class="bi bi-telephone-fill"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold ">E-mail</h6>
                                    <p class="card-text" id="email"></p>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold"> Social links</h6>
                                    <p class="card-text  mb-1"><i class="bi bi-facebook me-1"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text mb-1"><i class="bi bi-instagram me-1"></i>
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text"><i class="bi bi-twitter me-1"></i>
                                        <span id="tw"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold "> Iframe</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Contact us details  section Modal -->
                <div class="modal fade" id="contact-s" >
                    <div class="modal-dialog modal-lg">
                        <form id="contact_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Setting</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" id="address_inp" name="address"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Maps</label>
                                                    <input type="text" id="gmap_inp" name="gmap"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone No (with country
                                                        code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" id="pn1_inp" class="form-control shadow-none"
                                                            name="pn1">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" id="pn2_inp" class="form-control shadow-none"
                                                            name="pn2">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="text" id="email_inp" name="email"
                                                        class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-facebook"></i></span>
                                                        <input type="text" id="fb_inp" class="form-control shadow-none"
                                                            name="fb" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-instagram"></i></span>
                                                        <input type="text" id="insta_inp"
                                                            class="form-control shadow-none" name="insta" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-twitter"></i></span>
                                                        <input type="text" id="tw_inp" class="form-control shadow-none"
                                                            name="tw">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <label class="form-label fw-bold">iFrame Src</label>
                                                        <input type="text" id="iframe_inp"
                                                            class="form-control shadow-none" name="iframe">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="this.blur(); contacts_inp(contacts_data)"
                                        class="btn shadow-none text-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Management Team Setting section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Management Team</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#team-s">
                                <i class="bi bi-plus-square me-1"></i>Add
                            </button>
                        </div>

                        <div class="row" id="team-data">
                            <!-- <div class="col-md-2 mb-3">
                                <div class="card bg-dark text-white">
                                    <img src="../images/about/team.jpg" class="card-img" >
                                    <div class="card-img-overlay text-end">
                                        <button class="btn btn-danger btn-sm shadow-none float-end" type="button">
                                            <i class="bi bi-trash"></i>Delete
                                        </button>
                                        
                                    </div>
                                    <p class="card-text text-center px-3 py-2">Random Name</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>


                <!-- Management Team Setting section Modal -->
                <div class="modal fade" id="team-s" >
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Team Member</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" id="member_name_inp" name="member_name"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture </label>
                                        <input type="file" name="member_picture" id="member_picture_inp"
                                            class="form-control shadow-none" accept=".jpg,png,.webp,.jpeg" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn shadow-none text-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>



    <?php require('inc/scripts.php') ?>
    <script src="scripts/setting.js"></script>

</body>

</html>