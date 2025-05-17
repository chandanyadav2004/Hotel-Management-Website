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
                <div class="modal fade" id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                        <input type="text" id="pn1_inp" class="form-control shadow-none"
                                                            name="pn1">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="text" id="pn2_inp" class="form-control shadow-none"
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

                        </div>
                    </div>
                </div>


                <!-- Management Team Setting section Modal -->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <button type="button" onclick="" class="btn shadow-none text-secondary"
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
    <script>
        let general_data, contacts_data;
        let site_title_inp = document.getElementById('siteTitleInp');
        let site_about_inp = document.getElementById('siteAboutInp');

        let general_s_form = document.getElementById('general_s_form');
        general_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value)

        });

        let contact_s_form = document.getElementById('contact_s_form');
        contact_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            upd_contacts();
        });

        let team_s_form = document.getElementById('team_s_form');
        let member_name_inp = document.getElementById('member_name_inp');
        let member_picture_inp = document.getElementById('member_picture_inp');


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


        function get_contacts() {
            let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw'];
            let iframe = document.getElementById('iframe');




            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                // general_data = JSON.parse(this.response);
                contacts_data = JSON.parse(this.response);
                // console.log(contacts_data);
                contacts_data = Object.values(contacts_data);
                // console.log(contacts_data);
                for (let i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];

                }
                iframe.src = contacts_data[9];
                contacts_inp(contacts_data);



            }

            xhr.send('get_contacts');
        }

        function contacts_inp(contacts_data) {
            let contacts_p_id_input = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'iframe_inp'];
            for (let i = 0; i < contacts_p_id_input.length; i++) {
                document.getElementById(contacts_p_id_input[i]).value = contacts_data[i + 1];
            }

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

        function upd_contacts() {
            let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw', 'iframe'];
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'iframe_inp'];
            let data_str = "";
            for (let i = 0; i < contacts_inp_id.length; i++) {
                data_str += index[i] + '=' + document.getElementById(contacts_inp_id[i]).value + '&';
            }
            data_str += 'upd_contacts';
            // console.log(data_str);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                var myModal = document.getElementById('contact-s')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide() // Hide the modal
                if (this.response == 1) {
                    get_contacts();
                    alert('success', 'Updated successfully');
                } else {
                    alert('error', 'Not Updated successfully');
                }
            }
            xhr.send(data_str);
        }


        team_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_member();
        });


        function add_member() {
            let form_data = new FormData();
            form_data.append('member_name', name);
            form_data.append('member_picture', picture);
            form_data.append('add_member', true);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/settings_crud.php', true);

            xhr.onload = function () {
                var myModal = document.getElementById('team-s')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide() // Hide the modal
                if (this.response == 1) {
                    get_team();
                    alert('success', 'Member added successfully');
                } else {
                    alert('error', 'Member not added successfully');
                }
            }

            xhr.send(form_data);
        }

        window.onload = function () {
            get_general();
            get_contacts();
        }

    </script>

</body>

</html>