<?php
    require "init.php";

    $paid = $db->query("SELECT id, customer_id, customer_name FROM orders WHERE status=1 GROUP BY customer_id ORDER BY id;")->fetchAll();
    $unpaid = $db->query("SELECT id, customer_id, customer_name FROM orders WHERE status=0 GROUP BY customer_id ORDER BY id;")->fetchAll();
    
    
    $count = $db->query("SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;")->fetchAll();

    
    $data = json_encode($count);
    echo $data;
?>