<?php
require_once("init.php");

if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$customer_id = $_POST['customer_id'];

if(count($_POST) > 0){
    if (isset($_POST['queue'])) {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id='$customer_id';");
        $stmt->execute();
        $stmt->store_result();

        echo ($stmt->num_rows > 0) ? "true" : "false";
    }else if (isset($_POST['orderdone'])) {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id='$customer_id';");
        $stmt->execute();
        $stmt->store_result();

        echo ($stmt->num_rows > 0) ? "false" : "true";
    }else if (isset($_POST['paid'])){
        $stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id='$customer_id' AND status=1;");
        $stmt->execute();
        $stmt->store_result();

        echo ($stmt->num_rows > 0) ? "true" : "false";
    }
}else {
    echo "false";
}

?>