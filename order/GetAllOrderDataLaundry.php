<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT `order_id`, `order_status`, `order_payment` FROM `order` 
WHERE `laundry_id` = '" . $laundry_id . "' ORDER BY `order_timestamp` DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array('order_id' => $row["order_id"], 'order_status' => $row["order_status"], 
        'order_payment' => $row["order_payment"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>