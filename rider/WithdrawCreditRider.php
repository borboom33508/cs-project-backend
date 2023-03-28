<?php
include "../DbConnect.php";

$response = array();
$request = array();

$rider_id = $_POST['rider_id'];
$withdraw = $_POST['withdraw'];
$tx_paymentType = $_POST['tx_paymentType'];
$tx_amount = $_POST['tx_amount'];

$sql = "UPDATE rider SET rider_credit = rider_credit - '" . $withdraw . "' WHERE rider_id = '" . $rider_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $sql = "INSERT INTO `transaction`(`rider_id`, `tx_paymentType`, `tx_amount`)
    VALUES ('" . $rider_id . "', '" . $tx_paymentType . "', '" . $tx_amount . "')";

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
