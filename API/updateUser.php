<?php
require_once("init.php");

$customer_id = $_POST['customer_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$mobile_number = $_POST['mobile_number'];
$response = array();

$stmt = $conn->prepare("UPDATE customer SET first_name=?, last_name=?, mobile_number=? WHERE id=?;");
$stmt->bind_param("sssd", $first_name, $last_name, $mobile_number, $customer_id);
$stmt->execute();

if($stmt->error){        
    $response['error'] = true;
    $response['status'] = 'Update Error';
}else{
    $response['error'] = false;
    $response['status'] = 'User updated!';
}
$stmt->close();

echo json_encode($response);
