<?php
require_once("init.php");
if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$customer_id = $_POST['customer_id'];

$stmt = $conn->prepare("SELECT customer_name, total, date FROM transactions WHERE customer_id=? ORDER BY date DESC;");
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$stmt->bind_result($customer_name, $total, $date);

$recentorders = array();

while($stmt->fetch()){
    $temp = array();

    $temp['customer_name'] = $customer_name;
    $temp['total'] = $total;
    $temp['date'] = $date;

    array_push($recentorders, $temp);
}
echo json_encode($recentorders);

?>