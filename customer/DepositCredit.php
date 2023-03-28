<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_id = $_POST['cus_id'];
$deposit = $_POST['deposit'];
$tx_paymentType = $_POST['tx_paymentType'];
$tx_amount = $_POST['tx_amount'];

$sql = "UPDATE customer SET cus_credit = cus_credit + '" . $deposit . "' WHERE cus_id = '" . $cus_id . "'";

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

echo json_encode($response);
mysqli_close($conn);
?>
