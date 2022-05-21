<?php
require_once 'init.php';
if (mysqli_connect_errno()) {
    die('error ' . mysqli_connect_error());
}

$stmt = $conn->prepare('SELECT queue_id, id, customer_id, customer_name, status FROM orders GROUP BY id, customer_id ORDER BY id;');
$stmt->execute();
$stmt->bind_result($queue_id, $id, $customer_id, $customer_name, $status);

$orders = [];

while ($stmt->fetch()) {
    $temp = [];

    $temp['queue_id'] = $queue_id;
    $temp['id'] = $id;
    $temp['customer_id'] = $customer_id;
    $temp['customer_name'] = $customer_name;
    $temp['status'] = $status;

    array_push($orders, $temp);
}
echo json_encode($orders);

?>
