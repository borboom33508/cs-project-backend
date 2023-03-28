<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_id = $_GET['cus_id'];

$sql = "SELECT cus_placeName, cus_lat, cus_lng  FROM customer WHERE cus_id = '" . $cus_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('cus_placeName' => $row["cus_placeName"], 'cus_lat' => $row["cus_lat"], 'cus_lng' => $row["cus_lng"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
