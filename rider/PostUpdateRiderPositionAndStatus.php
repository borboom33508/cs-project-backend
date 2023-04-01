<?php
include "../DbConnect.php";

$response = array();

$order_id = $_POST['order_id'];
$rider_id1 = $_POST['rider_id1'];
$order_status = $_POST['order_status'];
$order_rider_location = $_POST['order_rider_location'];


$sql =  "UPDATE `order` SET `rider_id1` = '" . $rider_id1 . "', `order_status` = '" . $order_status . "', 
`order_rider_location` = '" . $order_rider_location . "', `order_timestamp` = now() WHERE `order_id` = '" . $order_id . "'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>