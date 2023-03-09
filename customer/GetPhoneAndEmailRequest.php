<?php
include "../DbConnect.php";

$response = array();
$request = array();

$sql = "SELECT cus_email, cus_phone FROM customer";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('cus_email' => $row["cus_email"], 'cus_phone' => $row["cus_phone"]);
    }
    $response['customer'] = true;
    $response['request'] = $request;
} else {
    $response['customer'] = false;
}

if ($response["customer"]["false"]) {
    $sql = "SELECT cus_email, cus_phone FROM rider";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $request = array('cus_email' => $row["cus_email"], 'cus_phone' => $row["cus_phone"]);
        }
        $response['rider'] = true;
        $response['request'] = $request;
    } else {
        $response['rider'] = false;
    }
}

echo json_encode($response);
mysqli_close($conn);
?>