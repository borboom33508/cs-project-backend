<?php
include "../DbConnect.php";

header('Access-Control-Allow-Origin: *');

$response = array();
$request = array();

$laundry_id = $_GET['laundry_id'];

$sql = "SELECT laundry_credit, laundry_accountNumber, laundry_bankName, laundry_ownerFname, laundry_ownerLname, laundry_phone  FROM laundry WHERE laundry_id = '" . $laundry_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('laundry_credit' => $row["laundry_credit"], 'laundry_accountNumber' => $row["laundry_accountNumber"], 'laundry_bankName' => $row["laundry_bankName"], 
        'laundry_ownerFname' => $row['laundry_ownerFname'], 'laundry_ownerLname' => $row["laundry_ownerLname"], 'laundry_phone' => $row["laundry_phone"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
