<?php
require_once 'init.php';
if (mysqli_connect_errno()) {
    die('error ' . mysqli_connect_error());
}

$customer_id = $_POST['customer_id'];

$st = $conn->prepare('SET sql_mode = '';');
$st->execute();

$stmt = $conn->prepare("SELECT id, waittime FROM orders WHERE date <= (SELECT date from orders where customer_id='$customer_id' ORDER BY date DESC LIMIT 1) AND id <= (SELECT id from orders where customer_id='$customer_id' ORDER BY date DESC LIMIT 1) GROUP BY customer_id;");
$stmt->execute();
$stmt->bind_result($time);

$total = 0;
while ($stmt->fetch()) {
    $total += $time;
}

echo $total;

?>
