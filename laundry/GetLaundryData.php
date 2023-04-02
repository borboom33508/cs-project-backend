<?php
include "../DbConnect.php";

header('Access-Control-Allow-Origin: *');

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT laundry_name, laundry_email, laundry_phone, laundry_picture, laundry_hours, laundry_rating, laundry_location, laundry_ownerFname, laundry_ownerLname, laundry_credit  FROM laundry WHERE laundry_id = '" . $laundry_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('laundry_name' => $row["laundry_name"], 'laundry_email' => $row["laundry_email"], 'laundry_phone' => $row["laundry_phone"], 
        'laundry_picture' => $row['laundry_picture'], 'laundry_hours' => $row["laundry_hours"], 'laundry_rating' => $row["laundry_rating"], 'laundry_location' => $row["laundry_location"],
        'laundry_ownerFname' => $row["laundry_ownerFname"], 'laundry_ownerLname' => $row["laundry_ownerLname"], 'laundry_credit' => $row["laundry_credit"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
