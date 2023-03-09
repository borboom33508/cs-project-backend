<?php
include "../DbConnect.php";

$response = array();

$cus_email = $_POST['cus_email'];
$cus_phone = $_POST['cus_phone'];
$cus_password = $_POST['cus_password'];
$cus_name = $_POST['cus_name'];

$sql = "INSERT INTO customer(cus_email, cus_phone, cus_password, cus_name)
VALUES ('" . $cus_email . "', '" . $cus_phone . "', '" . $cus_password . "', '" . $cus_name . "')";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>