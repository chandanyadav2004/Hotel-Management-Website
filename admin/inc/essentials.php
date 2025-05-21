<?php

// Frontend upload process need this data
define('SITE_URL', 'http://127.0.0.1/Hotel-Management-Website/');
define('ABOUT_IMG_PATH', SITE_URL . 'images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL . 'images/carousel/');
define('FACILITIES_IMG_PATH', SITE_URL . 'images/facilities/');





// Backend upload process need this data

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Hotel-Management-Website/images/');
define('ABOUT_FLODER', 'about/');
define('CAROUSEL_FLODER', 'carousel/');
define('FACILITIES_FLODER', 'facilities/');

// define('ROOM_FLO', '');


function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true)) {
        redirect('index.php');
        exit;
    }
    // session_regenerate_id(true);
}



function redirect($url)
{
    echo "<script>window.location.href='$url'</script>";
}



function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}


function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/jpg'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // invalid image
    } else if ($image['size'] > 2000000) {
        return 'inv_size'; // invalid size
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG' . random_int(11111111, 9999999999) . "." . $ext;
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // return image name
        } else {
            return 'upd_failed'; // invalid upload
        }


    }
}

function deleteImage($img_name, $folder)
{
    $img_path = UPLOAD_IMAGE_PATH . $folder . $img_name;
    if (file_exists($img_path)) {
        unlink($img_path);
        return true;
    } else {
        return false;
    }
}

function uploadSVGImage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // invalid image
    } else if ($image['size'] > 2000000) {
        return 'inv_size'; // invalid size
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG' . random_int(11111111, 9999999999) . "." . $ext;
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // return image name
        } else {
            return 'upd_failed'; // invalid upload
        }


    }
}


?>