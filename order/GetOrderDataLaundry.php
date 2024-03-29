<?php
include "../DbConnect.php";

$response = array();
$request = array();

$order_id = $_GET['order_id'];

$sql = "SELECT `orderdetail`.`order_detail_id`,`order`.`order_status`, `order`.`order_payment`, 
`orderdetail`.`order_service_type`, `orderdetail`.`order_washingKg`, `orderdetail`.`order_isReed`, 
`orderdetail`.`order_description`, `orderdetail`.`order_fixedCost_by_laundry`, `laundry`.`laundry_hours`,
`orderdetail`.`order_firstRideCost`, `orderdetail`.`order_secondRideCost`, `orderdetail`.`order_finalCost`,
`customer`.`cus_name`, `customer`.`cus_phone`, `customer`.`cus_placeName`, `laundry`.`laundry_id`,
`orderdetail`.`order_shirt`, `orderdetail`.`order_tshirt`, `orderdetail`.`order_sLeg`, 
`orderdetail`.`order_lLeg`, `orderdetail`.`order_jean`, `orderdetail`.`order_underwear`, 
`orderdetail`.`order_sock`, `orderdetail`.`order_other`, `orderdetail`.`order_reed_tshirt`, `orderdetail`.`order_reed_shirt`,
`orderdetail`.`order_reed_sLeg`, `orderdetail`.`order_reed_lLeg`, `orderdetail`.`order_reed_jean`, `orderdetail`.`order_reed_underwear`,
`orderdetail`.`order_reed_sock`, `orderdetail`.`order_reed_other` FROM `order` 
INNER JOIN `orderdetail` ON `order`.`order_detail_id` = `orderdetail`.`order_detail_id`
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
INNER JOIN `customer` ON `order`.`cus_id` = `customer`.`cus_id`
WHERE `order`.`order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array(
            'order_detail_id' => $row["order_detail_id"], 'order_status' => $row["order_status"], 
            'order_payment' => $row["order_payment"],'order_service_type' => $row["order_service_type"], 
            'order_washingKg' => $row["order_washingKg"], 'order_isReed' => $row["order_isReed"], 
            'order_description' => $row["order_description"], 'order_fixedCost_by_laundry' => $row["order_fixedCost_by_laundry"], 
            'laundry_hours' => $row["laundry_hours"], 'order_firstRideCost' => $row["order_firstRideCost"], 
            'order_secondRideCost' => $row["order_secondRideCost"], 'cus_name' => $row["cus_name"], 
            'cus_phone' => $row["cus_phone"], 'cus_placeName' => $row["cus_placeName"], 'order_finalCost' => $row["order_finalCost"],
            'laundry_id' => $row["laundry_id"], 'order_shirt' => $row["order_shirt"], 'order_tshirt' => $row["order_tshirt"], 
            'order_sLeg' => $row["order_sLeg"], 'order_lLeg' => $row["order_lLeg"], 'order_jean' => $row["order_jean"], 
            'order_underwear' => $row["order_underwear"], 'order_sock' => $row["order_sock"],
            'order_other' => $row["order_other"], 'order_reed_tshirt' => $row["order_reed_tshirt"], 'order_reed_shirt' => $row["order_reed_shirt"],
            'order_reed_sLeg' => $row["order_reed_sLeg"], 'order_reed_lLeg' => $row["order_reed_lLeg"], 'order_reed_jean' => $row["order_reed_jean"],
            'order_reed_underwear' => $row["order_reed_underwear"], 'order_reed_sock' => $row["order_reed_sock"], 
            'order_reed_other' => $row["order_reed_other"]
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