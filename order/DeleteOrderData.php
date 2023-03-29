<?php
include "../DbConnect.php";

$response = array();

$order_id = $_POST['order_id'];
$order_detail_id = $_POST['order_detail_id'];

$sql =  "DELETE FROM `order` WHERE `order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $sql =  "DELETE FROM `orderdetail` WHERE `order_detail_id` = '" . $order_detail_id . "'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response['success'] = true;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
