<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT `tx_id`, `tx_paymentType`, `tx_amount`, `tx_timestamp` FROM `transaction` 
WHERE `laundry_id` = '" . $laundry_id . "' ORDER BY tx_timestamp DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array('tx_id' => $row["tx_id"], 'tx_paymentType' => $row["tx_paymentType"], 
        'tx_amount' => $row["tx_amount"], 'tx_timestamp' => $row["tx_timestamp"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>