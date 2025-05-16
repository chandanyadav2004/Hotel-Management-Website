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
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="card border-0 shadow-sm ">
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
                                        <span id="pn1"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold ">E-mail</h6>
                                    <p class="card-text" id="email"></p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>



    <?php require('inc/scripts.php') ?>
    <script>
        let general_data;
        let site_title_inp = document.getElementById('siteTitleInp');
        let site_about_inp = document.getElementById('siteAboutInp');

        let general_s_form = document.getElementById('general_s_form');
        general_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value)

        });

        function get_general() {
            let site_title = document.getElementById('siteTitle');
            let site_about = document.getElementById('siteAbout');

            let shutdown_toggle = document.getElementById('shutdown-toggle');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

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
            }

            xhr.send('get_general');
        }


        function upd_general(site_title, site_about) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                var myModal = document.getElementById('general-s')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide() // Hide the modal
                if (this.response == 1) {
                    get_general();
                    alert('success', 'Updated successfully');
                } else {
                    alert('error', 'Not Updated successfully');
                }
            }

            xhr.send('site_title=' + site_title + '&site_about=' + site_about + '&upd_general');
        }

        function upd_shutdown(value) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert('success', 'Site has been shutdown successfully');
                } else {
                    alert('success', 'Site has been not  shutdown  successfully');
                }
                get_general();
            }

            xhr.send('upd_shutdown=' + value);
        }


        window.onload = function () {
            get_general();
        }

    </script>

</body>

</html>