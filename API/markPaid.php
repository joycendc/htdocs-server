<?php
require_once("init.php");

$queue_id = $_POST['queue_id'];
$response = array();

if(isset($_POST['queue_id'])){
    $stmt = $conn->prepare("UPDATE orders SET status=1 WHERE queue_id=?;");
    $stmt->bind_param("s", $queue_id);
    $stmt->execute();
    $stmt->store_result();  

    if($stmt->error){        
        $response['error'] = false;
        $response['message'] = 'PLEASE PLACE YOUR ORDER FIRST '.$stmt->num_rows;
        $stmt->close();
    }else{
        $response['error'] = false;
        $response['message'] = 'PAYMENT SUCCESS';
        $stmt->close();
    }
}else{
    $response['error'] = true;
    $response['message'] = 'PAYMENT ERROR';
}

echo json_encode($response);