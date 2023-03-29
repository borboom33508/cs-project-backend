<?php
include "../DbConnect.php";

$response = array();
$request_cus = array();
$request_laundry = array();

$cus_id = $_GET['cus_id'];
$laundry_id = $_GET['laundry_id'];

$sql = "SELECT cus_placeName, cus_lat, cus_lng  FROM customer WHERE cus_id = '" . $cus_id . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request_cus = array('cus_placeName' => $row["cus_placeName"], 'cus_lat' => $row["cus_lat"], 'cus_lng' => $row["cus_lng"]);
    }
    $sql = "SELECT laundry_location FROM laundry WHERE laundry_id = '" . $laundry_id . "'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $request_laundry = array('laundry_location' => $row["laundry_location"]);
        }
    }
    $response['request'] = $request_cus + $request_laundry;
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>