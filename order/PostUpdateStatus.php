<?php
include "../DbConnect.php";

$response = array();

$order_id = $_POST['order_id'];
$order_detail_id = $_POST['order_detail_id'];
$order_status = $_POST['order_status'];
$order_payment = $_POST['order_payment'];
$order_finalCost = $_POST['order_finalCost'];

if ($order_finalCost) {
    $sql =  "UPDATE `order` SET `order_status` = '" . $order_status . "', `order_payment` = '" . $order_payment . "', 
    `order_timestamp` = now() WHERE `order_id` = '" . $order_id . "'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql =  "UPDATE `orderdetail` SET `order_finalCost` = '" . $order_finalCost . "' WHERE `order_detail_id` = '" . $order_detail_id . "'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false;
    }
} else {
    $sql =  "UPDATE `order` SET `order_status` = '" . $order_status . "', `order_timestamp` = now() WHERE `order_id` = '" . $order_id . "'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($order_status == "เสร็จสิ้นรายการ") {
            $laundry_id = $_POST['laundry_id'];
            $tx_paymentType = $_POST['tx_paymentType'];
            $tx_amount = $_POST['tx_amount'];

            $sql = "INSERT INTO `transaction`(`laundry_id`, `tx_paymentType`, `tx_amount`)
            VALUES ('" . $laundry_id . "', '" . $tx_paymentType . "', '" . $tx_amount . "')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['successTransaction'] = true;
            } else {
                $response['successTransaction'] = false;
            }

            $sql = "UPDATE laundry SET laundry_credit = laundry_credit + '" . $tx_amount . "' 
            WHERE laundry_id = '" . $laundry_id . "'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['successUpdateCredit'] = true;
            } else {
                $response['successUpdateCredit'] = false;
            }
        }
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
}

echo json_encode($response);
mysqli_close($conn);
?>