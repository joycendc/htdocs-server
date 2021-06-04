<?php
    require "init.php";

    $customers = $db->query("SELECT id, customer_id, customer_name FROM orders GROUP BY customer_id ORDER BY id;")->fetchAll();
    $data = json_encode($customers);
    echo $data;
?>