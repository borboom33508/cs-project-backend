<?php
include "../DbConnect.php";

date_default_timezone_set('Asia/Bangkok');
define('SITE_ROOT', realpath(dirname(__FILE__)));

$response = array();
$cus_id = $_POST['cus_id'];
$cus_name = $_POST['cus_name'];
$cus_email = $_POST['cus_email'];
$cus_picture = $_POST['cus_picture'];

if ($_FILES) {
    $file_name = $_FILES["photo"]["name"];
    $photo_tmp_name = $_FILES["photo"]["tmp_name"];

    $target_dir = "../customerAssets/";

    $newFile_name = date('YmdHis') . "_" . $file_name;
    $upload_name = "/" . $target_dir . "/" . $newFile_name;

    if (move_uploaded_file($photo_tmp_name, SITE_ROOT . $upload_name)) {
        $sql = "UPDATE customer SET cus_name='" . $cus_name . "', cus_email='" . $cus_email . "', 
        cus_picture='" . $newFile_name . "' WHERE cus_id='" . $cus_id . "'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $response['success'] = true;
            unlink('../customerAssets/' . $cus_picture);
        } else {
            $response['success'] = false;
        }
    }
} else {
    $sql = "UPDATE customer SET cus_name='" . $cus_name . "', cus_email='" . $cus_email . "'
    WHERE cus_id='" . $cus_id . "'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
}
echo json_encode($response);
mysqli_close($conn);
?>