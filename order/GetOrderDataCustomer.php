<?php
include "../DbConnect.php";

$response = array();
$request = array();

$order_id = $_GET['order_id'];

$sql = "SELECT `order`.`order_status`, `order`.`order_payment`, `orderdetail`.`order_service_type`, 
`orderdetail`.`order_washingKg`, `orderdetail`.`order_isReed`, `orderdetail`.`order_description`, 
`orderdetail`.`order_fixedCost_by_laundry`, `orderdetail`.`order_finalCost`, `laundry`.`laundry_hours`, 
`customer`.`cus_credit`, `orderdetail`.`order_firstRideCost`, `orderdetail`.`order_secondRideCost` FROM `order` 
INNER JOIN `orderdetail` ON `order`.`order_detail_id` = `orderdetail`.`order_detail_id`
INNER JOIN `laundry` ON `order`.`laundry_id` = `laundry`.`laundry_id`
INNER JOIN `customer` ON `order`.`cus_id` = `customer`.`cus_id`
WHERE `order`.`order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array(
            'order_status' => $row["order_status"], 'order_payment' => $row["order_payment"],
            'order_service_type' => $row["order_service_type"], 'order_washingKg' => $row["order_washingKg"],
            'order_isReed' => $row["order_isReed"], 'order_description' => $row["order_description"],
            'order_fixedCost_by_laundry' => $row["order_fixedCost_by_laundry"], 'order_finalCost' => $row["order_finalCost"],
            'laundry_hours' => $row["laundry_hours"], 'cus_credit' => $row["cus_credit"], 
            'order_firstRideCost' => $row["order_firstRideCost"], 'order_secondRideCost' => $row["order_secondRideCost"]
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