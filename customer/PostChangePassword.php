<?php
include "../DbConnect.php";

$response = array();

$cus_id = $_POST['cus_id'];
$cus_password = $_POST['cus_password'];

$sql =  "UPDATE customer SET cus_password='" . $cus_password . "' WHERE cus_id='" . $cus_id . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>