<?php
include "../DbConnect.php";

$response = array();
$request = array();

$order_id = $_POST['order_id'];
$cus_id = $_POST['cus_id'];
$order_status = $_POST['order_status'];
$order_payment = $_POST['order_payment'];
$cus_credit = $_POST['cus_credit'];
$tx_paymentType =$_POST['tx_paymentType'];
$tx_amount =$_POST['tx_amount'];


$sql = "UPDATE `order` SET `order_status` = '" . $order_status . "', `order_payment` = '" . $order_payment . "', 
`order_timestamp` = now() WHERE `order_id` = '" . $order_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $sql = "UPDATE `customer` SET `cus_credit` = '" . $cus_credit . "' WHERE `cus_id` = '" . $cus_id . "'";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $sql = "INSERT INTO `transaction`(`cus_id`, `tx_paymentType`, `tx_amount`)
        VALUES ('" . $cus_id . "', '" . $tx_paymentType . "', '" . $tx_amount . "')";

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
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
