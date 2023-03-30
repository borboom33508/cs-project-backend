<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_id = $_GET['cus_id'];

$sql = "SELECT `order`.`order_id`, `order`.`order_status`, `order`.`order_payment`, `order`.`order_timestamp`,
`customer`.`cus_placename`, `laundry`.`laundry_name`, `order`.`rider_id2` FROM `order`
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
INNER JOIN `customer` ON `order`.`cus_id` = `customer`.`cus_id` 
WHERE `order`.`cus_id` = '" . $cus_id . "' ORDER BY `order`.`order_timestamp` DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array(
            'order_id' => $row["order_id"], 'order_status' => $row["order_status"],
            'order_payment' => $row["order_payment"], 'order_timestamp' => $row["order_timestamp"],
            'cus_placename' => $row["cus_placename"], 'laundry_name' => $row["laundry_name"],
            'rider_id2' => $row["rider_id2"]
        );
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>