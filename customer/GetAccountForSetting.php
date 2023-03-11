<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_id = $_GET['cus_id'];

$sql = "SELECT cus_name, cus_phone, cus_email, cus_credit FROM customer WHERE cus_id = '" . $cus_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('cus_name' => $row["cus_name"], 'cus_phone' => $row["cus_phone"], 'cus_email' => $row["cus_email"], 'cus_credit' => $row["cus_credit"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
