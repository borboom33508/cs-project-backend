<?php
include "../DbConnect.php";

$response = array();
$request = array();

$order_id = $_GET['order_id'];

$sql = "SELECT `order`.`order_source_location1`, `order`.`order_dest_location1`, `order`.`order_rider_location`, 
`order`.`order_status`, `rider`.`rider_fname`, `rider`.`rider_lname`, `rider`.`rider_phone`, 
`rider`.`rider_license_plate`, `rider`.`rider_picture` FROM `order` 
INNER JOIN `rider` ON `order`.`rider_id1` = `rider`.`rider_id` 
WHERE `order`.`order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array(
            'order_source_location1' => $row["order_source_location1"], 'order_dest_location1' => $row["order_dest_location1"],
            'order_rider_location' => $row["order_rider_location"], 'order_status' => $row["order_status"],
            'rider_fname' => $row["rider_fname"], 'rider_lname' => $row["rider_lname"], 'rider_phone' => $row["rider_phone"],
            'rider_license_plate' => $row["rider_license_plate"], 'rider_picture' => $row["rider_picture"]
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