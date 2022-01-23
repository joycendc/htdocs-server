<?php
require '../php/init.php';

   
$id = $_POST['id'];
$date = $_POST['date'];

$orders = $db->query("SELECT id, queue_id, item_name, qty, price FROM transactions WHERE queue_id='$id' AND date = '$date';")->fetchAll();

$data = json_encode($orders);
echo $data;

$db->close();

