<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_POST['laundry_id'];
$withdraw = $_POST['withdraw'];
$tx_paymentType = $_POST['tx_paymentType'];
$tx_amount = $_POST['tx_amount'];

$sql = "UPDATE laundry SET laundry_credit = laundry_credit - '" . $withdraw . "' WHERE laundry_id = '" . $laundry_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $sql = "INSERT INTO `transaction`(`laundry_id`, `tx_paymentType`, `tx_amount`)
    VALUES ('" . $laundry_id . "', '" . $tx_paymentType . "', '" . $tx_amount . "')";

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
