<?php
include "../DbConnect.php";

header('Access-Control-Allow-Origin: *');

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT laundry_credit  FROM laundry WHERE laundry_id = '" . $laundry_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('laundry_credit' => $row["laundry_credit"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
