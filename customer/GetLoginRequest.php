<?php
include "../DbConnect.php";

$response = array();
$request = array();

$cus_email = $_GET['cus_email'];
$cus_phone = $_GET['cus_phone'];
$cus_password = $_GET['cus_password'];

$sql = "SELECT cus_id FROM customer WHERE (cus_email = '" . $cus_email . "' || cus_phone = '" . $cus_phone . "') 
&& cus_password = '" . $cus_password . "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $request = array('cus_id' => $row["cus_id"]);
    }
    $response['success'] = true;
    $response['request'] = $request;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>
