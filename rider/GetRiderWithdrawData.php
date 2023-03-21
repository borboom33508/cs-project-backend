<?php
include "../DbConnect.php";

$response = array();
$request = array();

$rider_id = $_GET['rider_id'];

$sql = "SELECT rider_fname, rider_lname, rider_credit, rider_bankName, rider_accountNumber  FROM rider WHERE rider_id = '" . $rider_id . "' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('rider_fname' => $row["rider_fname"], 'rider_lname' => $row["rider_lname"], 'rider_credit' => $row["rider_credit"], 'rider_bankName' => $row['rider_bankName'],'rider_accountNumber' => $row["rider_accountNumber"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
