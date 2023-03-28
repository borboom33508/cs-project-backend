<?php
include "../DbConnect.php";

$response = array();

$cus_id = $_POST['cus_id'];
$placeName = $_POST['placeName'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$sql =  "UPDATE customer SET cus_placeName='". $placeName ."', cus_lat='" . $latitude . "', cus_lng='" . $longitude . "' WHERE cus_id='" . $cus_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>