<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_id = $_GET['cus_id'];

$sql = "SELECT `order`.`order_id`, `order`.`order_status`, `order`.`order_payment`
,`laundry`.`laundry_name` FROM `order` 
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
WHERE `cus_id` = '" . $cus_id . "' ORDER BY order_timestamp DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array('order_id' => $row["order_id"], 'order_status' => $row["order_status"], 
        'order_payment' => $row["order_payment"], 'laundry_name' => $row["laundry_name"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>