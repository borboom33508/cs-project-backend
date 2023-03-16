<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT laundry.laundry_name, laundry.laundry_location, laundry.laundry_picture, laundry.laundry_rating, 
services.service_1, services.service_2, services.service_3 FROM laundry
INNER JOIN services ON laundry.laundry_id = services.service_laundry_id
WHERE laundry_id = '" . $laundry_id . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('laundry_name' => $row["laundry_name"], 'laundry_location' => $row["laundry_location"], 'laundry_picture' => $row["laundry_picture"],
        'laundry_rating' => $row["laundry_rating"], 'service_1' => $row["service_1"], 'service_2' => $row["service_2"], 'service_3' => $row["service_3"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>