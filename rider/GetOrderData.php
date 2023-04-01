<?php
include "../DbConnect.php";

$response = array();
$request = array();

$rider_id = $_GET['rider_id'];

$sql = "SELECT `order`.`order_id`, `order`.`order_status`,`order`.`order_source_location1`, 
`order`.`order_dest_location1`, `order`.`order_rider_location`, `customer`.`cus_placeName`, 
`customer`.`cus_phone`, `laundry`.`laundry_name`, `laundry`.`laundry_phone` FROM `order`
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
INNER JOIN `customer` ON `order`.`cus_id` = `customer`.`cus_id`
WHERE `order`.`rider_id1` = '" . $rider_id . "' && (`order`.`order_status` = 'คนขับกำลังไปรับผ้า' || 
`order`.`order_status` = 'คนขับถึงที่อยู่ลูกค้าแล้ว' || `order`.`order_status` = 'คนขับกำลังไปส่งผ้า' )";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array(
            'order_id' => $row["order_id"], 'order_status' => $row["order_status"],
            'order_source_location1' => $row["order_source_location1"], 'order_dest_location1' => $row['order_dest_location1'],
            'order_rider_location' => $row["order_rider_location"], 'cus_placeName' => $row["cus_placeName"], 
            'cus_phone' => $row["cus_phone"], 'laundry_name' => $row["laundry_name"], 
            'laundry_phone' => $row["laundry_phone"]
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