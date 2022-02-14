<?php
require_once("init.php");

$customer_id = $_POST['customer_id'];

$stmt = $conn->prepare("DELETE FROM orders WHERE customer_id=?;");
$stmt->bind_param("s", $customer_id);

if ($stmt->execute()) {
    $stmt->close();
    $response['error'] = false;
    $response['message'] = "Order Cancelled !";
}else {
    $stmt->close();
    $response['error'] = true;
    $response['message'] = "Order Cannot be camcelled !";
}

echo json_encode($response);

mysqli_close($conn);
?>