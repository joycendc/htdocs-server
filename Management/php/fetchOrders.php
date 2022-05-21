<?php
require 'init.php';

$db->query('SET sql_mode = ""');

$orders = $db->query('SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;')->fetchAll();

$data = json_encode($orders);
echo $data;

?>
