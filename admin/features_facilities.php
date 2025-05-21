<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if (isset(($_GET['seen']))) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        $res = update($q, $values, 'i');
        if ($res == 1) {
            alert('success', 'Query marked all as read');
        } else {
            alert('error', 'Unable to mark query  all as read');
        }
        header('Location: user_queries.php');
        exit;

    } else {
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        $res = update($q, $values, 'ii');
        if ($res == 1) {
            alert('success', 'Query marked as read');
        } else {
            alert('error', 'Unable to mark query as read');
        }
        header('Location: user_queries.php');
        exit;
    }
}
if (isset(($_GET['del']))) {
    $frm_data = filteration($_GET);

    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries` ";

        if (mysqli_query($con, $q)) {
            alert('success', 'Deleted all queries');
        } else {
            alert('error', 'Operation failed');
        }
        header('Location: user_queries.php');
        exit;

    } else {
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if (delete($q, $values, 'i')) {
            alert('success', 'Deleted as read');
        } else {
            alert('error', 'Unable to unable as read');
        }
        header('Location: user_queries.php');
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features and Facilities </title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Features and Facilities </h3>

                <!-- Features section Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#feature-s">
                                <i class="bi bi-plus-square me-1"></i>Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead >
                                    <tr class="bg-dark text-light">
                                        <th scope="col">SrNo.</th>
                                        <th scope="col">Name</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#facility-s">
                                <i class="bi bi-plus-square me-1"></i>Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead >
                                    <tr class="bg-dark text-light">
                                        <th scope="col">SrNo.</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Features section Modal -->
    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" id="feature_name_inp" name="feature_name"
                                class="form-control shadow-none" required>
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

    <!-- Facility section Modal -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facilities_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Facility</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="facility_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon </label>
                            <input type="file" name="facility_icon" class="form-control shadow-none" accept=".svg"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="3"></textarea>
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


    <?php require('inc/scripts.php') ?>
    <script>
        let feature_s_form = document.getElementById("feature_s_form");
        let facilities_s_form = document.getElementById("facilities_s_form");
        feature_s_form.addEventListener("submit", function (e) {
            e.preventDefault();
            add_feature();
        });
        facilities_s_form.addEventListener("submit", function (e) {
            e.preventDefault();
            add_facility();
        });
        function add_feature() {
            let form_data = new FormData();
            form_data.append("name", feature_s_form.elements['feature_name'].value);
            form_data.append("add_feature", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);

            xhr.onload = function () {
                // console.log(this.response);
                var myModal = document.getElementById("feature-s");
                var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
                modal.hide(); // Hide the modal
                if (this.responseText == 1) {
                    alert("success", "Features added successfully");
                    feature_s_form.elements['feature_name'].value = "";
                    get_features();
                } else {
                    alert("error", "Unable to add features");

                }
            };

            xhr.send(form_data);
        }

        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                // console.log(this.response);
                document.getElementById("features-data").innerHTML = this.responseText;
            };

            xhr.send("get_features");
        }
        
        function rem_feature(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                // console.log(this.response);
                if (this.responseText == 1) {
                    alert("success", "Feature deleted successfully");
                    get_features();
                } else if (this.responseText == 'rooms_added') {
                    alert("error", "Unable to delete feature, it is already added in rooms");
                }
                else {
                    alert("error", "Unable to delete feature");
                }
            };

            xhr.send("rem_feature=" + id);
        }


        function add_facility() {
            let form_data = new FormData();
            form_data.append("name", facilities_s_form.elements['facility_name'].value);
            form_data.append("icon", facilities_s_form.elements['facility_icon'].files[0]);
            form_data.append("desc", facilities_s_form.elements['facility_desc'].value);
            form_data.append("add_feature", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);

            xhr.onload = function () {
                // console.log(this.response);
                var myModal = document.getElementById("facility-s");
                var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
                modal.hide(); // Hide the modal
                if (this.responseText == "inv_img") {
                    alert("error", "Only svg image are allowed");
                } else if (this.responseText == "inv_size") {
                    alert("error", "Image size should be less than 2MB");
                } else if (this.responseText == "upd_failed") {
                    alert("error", "Image upload failed");
                } else {
                    alert("success", "New Facility added successfully");
                    facilities_s_form.reset();
                    // get_members();
                    get_features();
                }
            };

            xhr.send(form_data);
        }

        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                // console.log(this.response);
                document.getElementById("facilities-data").innerHTML = this.responseText;
            };

            xhr.send("get_facilities");
        }
        function rem_facility(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                // console.log(this.response);
                if (this.responseText == 1) {
                    alert("success", "Facility deleted successfully");
                    get_features();
                } else if (this.responseText == 'rooms_added') {
                    alert("error", "Unable to delete facility, it is already added in rooms");
                }
                else {
                    alert("error", "Unable to delete facility");
                }
            };

            xhr.send("rem_facility=" + id);
        }



        window.onload = function () {
            get_features();
        }
    </script>


</body>

</html>