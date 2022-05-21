<?php
require_once 'init.php';
if (mysqli_connect_errno()) {
    die('error ' . mysqli_connect_error());
}

$customer_id = $_POST['customer_id'];

$stmt = $conn->prepare('SET sql_mode = ''; SELECT item_name, price, qty, total FROM (SELECT id, item_name, price, SUM(qty) AS qty, SUM(total) AS total FROM orders WHERE customer_id=? GROUP BY item_name) orders;');
$stmt->bind_param('s', $customer_id);
$stmt->execute();
$stmt->bind_result($item_name, $price, $qty, $total);

$orders = [];

while ($stmt->fetch()) {
    $temp = [];

    $temp['item_name'] = $item_name;
    $temp['price'] = $price;
    $temp['qty'] = $qty;
    $temp['total'] = $total;

    array_push($orders, $temp);
}
echo json_encode($orders);

?>
