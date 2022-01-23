<?php
require_once("init.php");

$customer_id = $_POST['customer_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$response = array();

//$stmt = $conn->prepare("INSERT INTO favorites (customer_id, item_id) VALUES (?, ?);");
//$stmt->bind_param("ss", $customer_id, $item_id);

/*
if ($stmt->execute()) {
    $response['error'] = false;
    $response['status'] = 'User Updated!';
    $stmt->close();
}else{
    $response['error'] = true;
    $response['status'] = 'Hello API';
    $stmt->close();
}
*/

$response['error'] = true;
$response['status'] = 'Hello API';

echo json_encode($response);
