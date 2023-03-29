<?php
include "../DbConnect.php";

$response = array();

$laundry_id = $_POST['laundry_id']
$rider_fname = $_POST['rider_fname'];
$rider_lname = $_POST['rider_lname'];
$rider_email = $_POST['rider_email'];
$rider_password = $_POST['rider_password'];
$rider_phone = $_POST['rider_phone'];
$rider_license_plate = $_POST['rider_license_plate'];
$rider_bankName = $_POST['rider_bankName'];
$rider_accountNumber = $_POST['rider_accountNumber'];

$sql = "INSERT INTO rider(rider_fname, rider_lname, rider_email, rider_password, rider_phone, rider_license_plate, rider_bankName, rider_accountNumber)
VALUES ('" . $rider_fname . "', '" . $rider_lname . "', '" . $rider_email . "', '" . $rider_password . "', '" . $rider_phone . "', '" . $rider_license_plate . "'
, '" . $rider_bankName . "', '" . $rider_accountNumber . "')";

$result = mysqli_query($conn, $sql);

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>