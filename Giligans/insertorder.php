<?php
require_once("init.php");

$queue_id = $_POST['queue_id'];
$customer_id = $_POST['customer_id'];
$customer_name = $_POST['customer_name'];
$waittime = $_POST['time'];
$orderlist = $_POST['orderlist'];
$cash = $_POST['cash'];
$type = $_POST['type'];
$isSenior = $_POST['senior'];
$table_number = $_POST['table_number'];
$orderarray = json_decode($orderlist, true);

$stmt = $conn->prepare("SELECT customer_id FROM orders WHERE customer_id=?;");
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$stmt->store_result();  

date_default_timezone_set('Asia/Manila');
$date = date_create();
$now = date_format($date,'Y-m-d H:i:s');

if ($stmt->num_rows > 0) {
    $response['error'] = true;
    $response['message'] = 'Existing order';
    $stmt->close();
}else{
    $array = array(); 
    foreach ($orderarray as $row) { 
        $array[] = "('" . $queue_id . "', '" . $customer_id . "', '" . $customer_name . "', '" . $row["name"] . "', '". $row["qty"] . "' ,'" . $row["price"] . "' ,'" . $row["total"] . "' ,'". $now . "' ,'" . $waittime . "', '" . $table_number . "', '" . $cash . "', '" . $type . "', '" . $isSenior . "')"; 
    } 
    $values = implode(", ", $array);

    $stmt = $conn->prepare("INSERT INTO orders (queue_id, customer_id, customer_name, item_name, qty, price, total, date, waittime, table_number, cash, type, isSenior) VALUES {$values}"); 
    $stmt->execute();
    

    $stmt->close();
    $response['error'] = false;
    $response['message'] = 'Order Placed';
}

echo json_encode($response);

mysqli_close($conn);

?>