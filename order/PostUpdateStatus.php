<?php
include "../DbConnect.php";

$response = array();

$order_id = $_POST['order_id'];
$order_status = $_POST['order_status'];

$sql =  "UPDATE `order` SET `order_status` = '" . $order_status . "' WHERE `order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>