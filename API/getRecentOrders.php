<?php
require_once("init.php");
if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$customer_id = $_POST['customer_id'];

$stmt = $conn->prepare("SELECT id, item_name, qty, price, customer_name, total, date FROM transactions WHERE customer_id=? ORDER BY id DESC;");
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$stmt->bind_result($id, $item_name, $qty, $price, $customer_name, $total, $date);

$recentorders = array();

while($stmt->fetch()){
    $temp = array();

    $temp['id'] = $id;
    $temp['item_name'] = $item_name;
    $temp['qty'] = $qty;
    $temp['price'] = $price;
    $temp['customer_name'] = $customer_name;
    $temp['total'] = $total;
    $temp['date'] = $date;

    array_push($recentorders, $temp);
}
echo json_encode($recentorders);

?>