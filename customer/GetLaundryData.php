<?php
include "../DbConnect.php";

$response = array();
$request = array();

$sql = "SELECT * FROM laundry";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request[] = array('laundry_id' => $row["laundry_id"], 'laundry_name' => $row["laundry_name"], 
        'laundry_picture' => $row["laundry_picture"], 'laundry_location' => $row["laundry_location"], 
        'laundry_hours' => $row["laundry_hours"], 'laundry_rating' => $row["laundry_rating"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>