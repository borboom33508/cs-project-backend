<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_email = $_GET['laundry_email'];
$laundry_phone = $_GET['laundry_phone'];
$laundry_password = $_GET['laundry_password'];

$sql = "SELECT laundry_id FROM laundry WHERE (laundry_email = '" . $laundry_email . "' || laundry_phone = '" . $laundry_phone . "') 
&& laundry_password = '" . $laundry_password . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('laundry_id' => $row["laundry_id"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
