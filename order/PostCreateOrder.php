<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_POST['laundry_id'];
$cus_id = $_POST['cus_id'];
$order_service_type = $_POST['order_service_type'];
$order_washingKg = $_POST['order_washingKg'];
$order_isReed = $_POST['order_isReed'];
$order_description = $_POST['order_description'];
$order_fixedCost_by_laundry = $_POST['order_fixedCost_by_laundry'];
$order_firstRideCost = $_POST['order_firstRideCost'];
$order_secondRideCost = $_POST['order_secondRideCost'];
$order_status = $_POST['order_status'];
$order_source_location = $_POST['order_source_location'];
$order_dest_location = $_POST['order_dest_location'];
$order_shirt = $_POST['order_shirt'];
$order_tshirt = $_POST['order_tshirt'];
$order_sLeg = $_POST['order_sLeg'];
$order_lLeg = $_POST['order_lLeg'];
$order_jean = $_POST['order_jean'];
$order_underwear = $_POST['order_underwear'];
$order_sock = $_POST['order_sock'];
$order_other = $_POST['order_other'];
$order_reed_tshirt = $_POST['order_reed_tshirt'];
$order_reed_shirt = $_POST['order_reed_shirt'];
$order_reed_sLeg = $_POST['order_reed_sLeg'];
$order_reed_lLeg = $_POST['order_reed_lLeg'];
$order_reed_jean = $_POST['order_reed_jean'];
$order_reed_underwear = $_POST['order_reed_underwear'];
$order_reed_sock = $_POST['order_reed_sock'];
$order_reed_other = $_POST['order_reed_other'];




if ($order_isReed) {
    $sql = "INSERT INTO `orderdetail`(`laundry_id`, `cus_id`, `order_service_type`, 
    `order_washingKg`, `order_isReed`, `order_description`, `order_fixedCost_by_laundry`, 
    `order_firstRideCost`, `order_secondRideCost`, `order_shirt`, `order_tshirt`, 
    `order_sLeg`, `order_lLeg`, `order_jean`, `order_underwear`, `order_sock`, `order_other`, `order_reed_tshirt`,
    `order_reed_shirt`, `order_reed_sLeg`, `order_reed_lLeg`, `order_reed_jean`, `order_reed_underwear`, `order_reed_sock`,
    `order_reed_other`) 
    VALUES ('" . $laundry_id . "','" . $cus_id . "','" . $order_service_type . "','" . $order_washingKg . "',
    '" . $order_isReed . "','" . $order_description . "','" . $order_fixedCost_by_laundry . "',
    '" . $order_firstRideCost . "','" . $order_secondRideCost . "','" . $order_shirt . "',
    '" . $order_tshirt  . "','" . $order_sLeg  . "','" . $order_lLeg  . "',
    '" . $order_jean  . "','" . $order_underwear  . "','" . $order_sock  . "', 
    '" . $order_other  . "', '" . $order_reed_tshirt  . "', '" . $order_reed_shirt  . "', '" . $order_reed_sLeg  . "', 
    '" . $order_reed_lLeg  . "', '" . $order_reed_jean  . "', '" . $order_reed_underwear  . "', '" . $order_reed_sock  . "',
    '" . $order_reed_other  . "')";
} else {
    $sql = "INSERT INTO `orderdetail`(`laundry_id`, `cus_id`, `order_service_type`, 
    `order_washingKg`, `order_description`, `order_fixedCost_by_laundry`, 
    `order_firstRideCost`, `order_secondRideCost`, `order_shirt`, `order_tshirt`, 
    `order_sLeg`, `order_lLeg`, `order_jean`, `order_underwear`, `order_sock`, `order_other`) 
    VALUES ('" . $laundry_id . "','" . $cus_id . "','" . $order_service_type . "','" . $order_washingKg . "',
    '" . $order_description . "','" . $order_fixedCost_by_laundry . "',
    '" . $order_firstRideCost . "','" . $order_secondRideCost . "','" . $order_shirt . "',
    '" . $order_tshirt  . "','" . $order_sLeg  . "','" . $order_lLeg  . "',
    '" . $order_jean  . "','" . $order_underwear  . "','" . $order_sock  . "',
    '" . $order_other  . "'), '" . $order_reed_tshirt  . "', '" . $order_reed_shirt  . "', '" . $order_reed_sLeg  . "', '" . $order_reed_lLeg  . "', 
    '" . $order_reed_jean  . "', '" . $order_reed_underwear  . "', '" . $order_reed_sock  . "', '" . $order_reed_other  . "'";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    $sql = "SELECT `order_detail_id` FROM `orderdetail` WHERE `cus_id` = '" . $cus_id . "' ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "INSERT INTO `order`(`order_detail_id`, `laundry_id`, `cus_id`, `order_status`, 
            `order_source_location1`, `order_source_location2`, `order_dest_location1`, `order_dest_location2`) 
            VALUES ('" . $row["order_detail_id"] . "','" . $laundry_id . "','" . $cus_id . "','" . $order_status . "',
            '" . $order_source_location . "','" . $order_dest_location . "','" . $order_dest_location . "',
            '" . $order_source_location  . "')";
        }
        $finalResult = mysqli_query($conn, $sql);

        if ($finalResult) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>