<?php
include "../DbConnect.php";

$response = array();
$request = array();

$rider_email = $_GET['rider_email'];
$rider_phone = $_GET['rider_phone'];
$rider_password = $_GET['rider_password'];

$sql = "SELECT rider_id FROM rider WHERE (rider_email = '" . $rider_email . "' || rider_phone = '" . $rider_phone . "') 
&& rider_password = '" . $rider_password . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('rider_id' => $row["rider_id"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>