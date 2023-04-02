<?php
include "../DbConnect.php";
date_default_timezone_set('Asia/Bangkok');
define('SITE_ROOT', realpath(dirname(__FILE__)));

$response = array();
$order_id = $_POST['order_id'];
$order_status = $_POST['order_status'];

$file_name = $_FILES["file"]["name"];
$photo_tmp_name = $_FILES["file"]["tmp_name"];

$target_dir = "../orderAssets/";

$newFile_name = date('YmdHis') . "_" . $file_name;
$upload_name = "/" . $target_dir . "/" . $newFile_name;

if (move_uploaded_file($photo_tmp_name, SITE_ROOT . $upload_name)) {
    $sql =  "UPDATE `order` SET `order_status` = '" . $order_status . "', 
        `order_confirm_picture1` = '" . $newFile_name . "', `order_timestamp` = now()
        WHERE `order_id` = '" . $order_id . "'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($order_status == "คนขับถึงร้านแล้ว") {
            $rider_id = $_POST['rider_id'];
            $tx_paymentType = $_POST['tx_paymentType'];
            $tx_amount = $_POST['tx_amount'];

            $sql = "INSERT INTO `transaction`(`rider_id`, `tx_paymentType`, `tx_amount`)
            VALUES ('" . $rider_id . "', '" . $tx_paymentType . "', '" . $tx_amount . "')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['successTransaction'] = true;
            } else {
                $response['successTransaction'] = false;
            }

            $sql = "UPDATE rider SET rider_credit = rider_credit + '" . $tx_amount . "' WHERE rider_id = '" . $rider_id . "'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['successUpdateCredit'] = true;
            } else {
                $response['successUpdateCredit'] = false;
            }
        }
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
}

echo json_encode($response);
mysqli_close($conn);
?>
