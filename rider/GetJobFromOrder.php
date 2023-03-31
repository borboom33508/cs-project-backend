<?php
include "../DbConnect.php";

$response = array();
$request = array();

$order_status = $_GET['order_status'];

$sql = "SELECT `order`.`order_id`, `order`.`order_source_location1`, `order`.`order_dest_location1`, 
`orderdetail`.`order_firstRideCost`, `laundry`.`laundry_name`, `customer`.`cus_placeName` FROM `order` 
INNER JOIN `orderdetail` ON `order`.`order_detail_id` = `orderdetail`.`order_detail_id`
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
INNER JOIN `customer` ON `order`.`cus_id` = `customer`.`cus_id`
WHERE `order`.`order_status` = '". $order_status ."'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array('order_id' => $row["order_id"], 'order_source_location1' => $row["order_source_location1"], 
        'order_dest_location1' => $row["order_dest_location1"], 'order_firstRideCost' => $row["order_firstRideCost"],
        'laundry_name' => $row["laundry_name"], 'cus_placeName' => $row["cus_placeName"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>