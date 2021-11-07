<?php
require_once("init.php");

$queue_id = $_POST['queue_id'];
$customer_id = $_POST['customer_id'];
$customer_name = $_POST['customer_name'];
$orderlist = $_POST['orderlist'];
$type = $_POST['type'];
$isSenior = $_POST['senior'];

$orderarray = json_decode($orderlist, true);

$stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id='$customer_id' AND status=1;");
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $stmt->close();
    $response['error'] = false;
    $response['message'] = 'Order is being Served';
}else {

    $stmt = $conn->prepare("SELECT customer_id FROM orders WHERE customer_id=?;");
    $stmt->bind_param("s", $customer_id);
    $stmt->execute();
    $stmt->store_result();  

    date_default_timezone_set('Asia/Manila');
    $date = date_create();
    $now = date_format($date,'Y-m-d H:i:s');

    if ($stmt->num_rows > 0) {
        $array = array(); 
        foreach ($orderarray as $row) { 
            $array[] = "('" . $queue_id . "', '" . $customer_id . "', '" . $customer_name . "', '" . $row["name"] . "', '". $row["qty"] . "' ,'" . $row["price"] . "' ,'" . $row["total"] . "' ,'". $now . "' , '" . $type . "', '" . $isSenior . "')"; 
        }  
        $values = implode(", ", $array);

        $stmt = $conn->prepare("INSERT INTO orders (queue_id, customer_id, customer_name, item_name, qty, price, total, date, type, isSenior) VALUES {$values}"); 
        $stmt->execute();
        

        $stmt->close();
        $response['error'] = false;
        $response['message'] = 'Order Added';
    
    }else{
        $array = array(); 
        foreach ($orderarray as $row) { 
            $array[] = "('" . $queue_id . "', '" . $customer_id . "', '" . $customer_name . "', '" . $row["name"] . "', '". $row["qty"] . "' ,'" . $row["price"] . "' ,'" . $row["total"] . "' ,'". $now . "' , '" . $type . "', '" . $isSenior . "')"; 
        } 
        $values = implode(", ", $array);

        $stmt = $conn->prepare("INSERT INTO orders (queue_id, customer_id, customer_name, item_name, qty, price, total, date, type, isSenior) VALUES {$values}"); 
        $stmt->execute();
        

        $stmt->close();
        $response['error'] = false;
        $response['message'] = 'Order Placed';
    }
}
echo json_encode($response);

mysqli_close($conn);

?>