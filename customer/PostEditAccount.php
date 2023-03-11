<?php
include "../DbConnect.php";

$response = array();

$cus_id = $_POST['cus_id'];
$cus_name = $_POST['cus_name'];
$cus_email = $_POST['cus_email'];

$sql =  "UPDATE customer SET cus_name='" . $cus_name . "', cus_email='" . $cus_email . "' WHERE cus_id='" . $cus_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>