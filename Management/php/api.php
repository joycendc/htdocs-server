<?php   
require "init.php";
$id = $_POST['id'];
if(isset($_POST['type'])){
    switch ($_POST['type']) {
        case 'remove':
            $db->query("INSERT INTO transaction (queue_id, customer_id, customer_name, item_name, qty, price, total, date, status)
                        SELECT queue_id, customer_id, customer_name, item_name, qty, price, total, date, status
                        FROM orders
                        WHERE customer_id=?;", $id);

            $db->query("DELETE FROM orders WHERE customer_id=?;", $id);

            $number = $db->query("SELECT mobile_number FROM customer WHERE id=?;", $id)->fetchAll();

            $mobile = $number[0]['mobile_number'];

            $apicode = "TR-CEPIE180472_1E94B";
            $passwd = "%cmh5lj4mj";
            $message = "YOUR ORDER IS READY PLEASE PROCEED TO COUNTER IMMDIATELY";

            // $result = notifyCustomer($mobile, $message, $apicode, $passwd);

            if ($result == ""){
                echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                Please CONTACT US for help. ";	
            } else if ($result == 0){
                echo "Message Sent!";
            } else{	
                echo "Error Num ". $result . " was encountered!";
            }
        break;
        case 'pay':
            $db->query("UPDATE orders SET status=1 WHERE customer_id=?;", $id);
        break;
    }
}

function notifyCustomer($number, $message, $apicode, $passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}
?>