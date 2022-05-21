<?php
require 'init.php';
/*
    $paid = $db->query("SELECT id, customer_id, customer_name FROM orders WHERE status=1 GROUP BY customer_id ORDER BY id;")->fetchAll();
    $unpaid = $db->query("SELECT id, customer_id, customer_name FROM orders WHERE status=0 GROUP BY customer_id ORDER BY id;")->fetchAll();
    */

$conn->exec('SET sql_mode = ''');

$orders = $db->query('SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;')->fetchAll();

$data = json_encode($orders);
echo $data;

/*

    while (true) {
        $lastOrders = $db->query("SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;")->fetchAll();
    
        sleep(1);

        $orders = $db->query("SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;")->fetchAll();
    
        // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
        if ($lastOrders != $orders) {
    
            $orders = $db->query("SELECT id, customer_id, customer_name, status FROM orders GROUP BY customer_id ORDER BY id;")->fetchAll();
    
            $data = json_encode($orders);
            echo $data;
    
            // leave this loop step
            //break;
    
        } else {
            continue;
        }
    }
    */

?>
