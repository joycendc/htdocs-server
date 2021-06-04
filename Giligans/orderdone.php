<?php
require_once("init.php");

$customer_id = $_POST['customer_id'];

$stmt = $conn->prepare("DELETE FROM orders WHERE customer_id=?;");
$stmt->bind_param("s", $customer_id);

if ($stmt->execute()) {
    $stmt->close();
    $response['error'] = false;
    $response['message'] = "Thank you, Come Again !";
}

echo json_encode($response);

mysqli_close($conn);
?>