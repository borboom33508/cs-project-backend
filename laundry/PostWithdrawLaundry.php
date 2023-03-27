<?php
include "../DbConnect.php";

$response = array();
$request = array();

$laundry_id = $_POST['laundry_id'];
$withdraw = $_POST['withdraw'];

$sql = "UPDATE laundry SET laundry_credit = laundry_credit - '" . $withdraw . "' WHERE laundry_id = '" . $laundry_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
