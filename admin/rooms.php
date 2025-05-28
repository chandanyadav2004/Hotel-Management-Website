<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms </title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rooms </h3>

                <!-- Features section Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-room">
                                <i class="bi bi-plus-square me-1"></i>Add
                            </button>
                        </div>


                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="add-room">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Area</label>
                                <input required type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Price</label>
                                <input required type="number" min="1" name="price" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Quantity</label>
                                <input required type="number" min="1" name="quantity" class="form-control shadow-none">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Adult(Max.)</label>
                                <input required type="number" min="1" name="adult" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Children(Max.)</label>
                                <input required type="number" min="1" name="children" class="form-control shadow-none">
                            </div>

                            <div class="col-lg-12 mb-3 ">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                           <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                    {$opt['name']}
                                                </label>
                                           </div>
                                    ";
                                    }


                                    ?>
                                </div>



                            </div>

                            <div class="col-lg-12 mb-3 ">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                           <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='facilities' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                    {$opt['name']}
                                                </label>
                                           </div>
                                    ";
                                    }


                                    ?>
                                </div>



                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control shadow-none" rows="4"
                                    required></textarea>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn shadow-none text-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div class="modal fade" id="edit-room">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Area</label>
                                <input required type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Price</label>
                                <input required type="number" min="1" name="price" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Quantity</label>
                                <input required type="number" min="1" name="quantity" class="form-control shadow-none">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Adult(Max.)</label>
                                <input required type="number" min="1" name="adult" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Children(Max.)</label>
                                <input required type="number" min="1" name="children" class="form-control shadow-none">
                            </div>

                            <div class="col-lg-12 mb-3 ">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                           <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                    {$opt['name']}
                                                </label>
                                           </div>
                                    ";
                                    }


                                    ?>
                                </div>



                            </div>

                            <div class="col-lg-12 mb-3 ">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                           <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='facilities' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                    {$opt['name']}
                                                </label>
                                           </div>
                                    ";
                                    }


                                    ?>
                                </div>



                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control shadow-none" rows="4"
                                    required></textarea>

                            </div>

                            <input type="hidden" name="room_id">

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn shadow-none text-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Manages room images  Modal -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Name </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert">

                    </div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .jpeg, .png .webp"
                                class="form-control shadow-none  mb-3" required>
                            <button class="btn custom-bg text-white shadow-none">Add</button>
                            <input type="hidden" name="room_id" value="">
                        </form>
                    </div>

                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>

                                </tr>
                            </thead>
                            <tbody id="room-image-data">
                            </tbody>
                        </table>
                    </div>




                </div>

            </div>
        </div>
    </div>




    <?php require('inc/scripts.php') ?>

    <script>


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

            add_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);

                }
            });
            let facilities = [];

            add_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    facilities.push(el.value);

                }
            });

            form_data.append("features", JSON.stringify(features));
            form_data.append("facilities", JSON.stringify(facilities));




            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/room.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
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
            }
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

                edit_room_form.elements['facilities'].forEach(el => {
                    if (data.facilities.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });
                edit_room_form.elements['features'].forEach(el => {
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });
            };

            xhr.send("get_room=" + id);

        }

        function submit_edit_room() {

            let form_data = new FormData();
            form_data.append('edit_room', '');
            form_data.append('room_id', edit_room_form.elements['room_id'].value);
            form_data.append('name', edit_room_form.elements['name'].value);
            form_data.append('area', edit_room_form.elements['area'].value);
            form_data.append('price', edit_room_form.elements['price'].value);
            form_data.append('quantity', edit_room_form.elements['quantity'].value);
            form_data.append('adult', edit_room_form.elements['adult'].value);
            form_data.append('children', edit_room_form.elements['children'].value);
            form_data.append('description', edit_room_form.elements['description'].value);

            let features = [];

            edit_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);

                }
            });
            let facilities = [];

            edit_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    facilities.push(el.value);

                }
            });

            form_data.append('features', JSON.stringify(features));
            form_data.append('facilities', JSON.stringify(facilities));

            console.log(form_data.get('room_id'));



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
            }
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

                if (this.responseText == 'inv_img') {
                    alert("error", "Invalid image format. Please upload a jpg, jpeg, png, or webp image.", 'image-alert');

                } else if (this.responseText == 'inv_size') {
                    alert("error", "Image size exceeds the limit of 2MB.", 'image-alert');

                } else if (this.responseText == 'upd_failed') {
                    alert("error", "Image upload failed . Server Down.", 'image-alert');

                } else {
                    alert("success", "Image added successfully", 'image-alert');
                    room_images(add_image_form.elements["room_id"].value, document.querySelector("#room-images .modal-title").innerText);
                    add_image_form.reset();
                    // get_room_images(add_image_form.elements["room_id"].value);

                }




            }
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

            }

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
                    alert("success", "Image removed successfully", 'image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                } else {
                    alert("error", "Unable to remove image", 'image-alert');
                }
            }
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
                    alert("success", "Image Thumbnail Changed successfully", 'image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                } else {
                    alert("error", "Unable to Changed Thumbnail image", 'image-alert');
                }
            }
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
                }
                xhr.send("remove_room=" + id);
            }

            
        }


        window.onload = function () {
            get_all_rooms();
        }

    </script>

</body>

</html>