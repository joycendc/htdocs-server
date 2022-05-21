<main id="viewholder">
    <div class="view">
        <?php      
    
    if (!empty($current_customer)) {              
    
    ?>

        <div class="top">
            <div class="user">
                <img class="avatar" src="./images/img_avatar.png" alt="Avatar">
                <span><?php echo $current['customer_name']; ?></span>
            </div>
            <h3><?php echo date('F d Y - h:i A', strtotime($current['date'])); ?></h3>
        </div>

        <div class="bottom">
            <ul class="orders">
                <?php      
            $total = 0;           

            $conn->exec('SET sql_mode = ''');


            $orders = $db->query("SELECT item_name, price, qty, total FROM (SELECT id, item_name, price, SUM(qty) AS qty, SUM(total) AS total FROM orders WHERE customer_id=? GROUP BY item_name) orders;", $current['customer_id'])->fetchAll(); 
            foreach ($orders as $order): 
                $total += $order['total'];
                $getitem = $db->query("SELECT url FROM items WHERE name=?;", $order['item_name'])->fetchAll(); 
            
                $item = $getitem[0]['url']; ?>
                <li class="item">
                    <img class="fooImg" src="../API/images/<?php echo $item; ?>" alt="Food" />
                    <h2>x<?php echo $order['qty']; ?></h2>
                    <h2>₱<?php echo $order['total']; ?></h2>
                    <h2><?php echo $order['item_name']; ?></h2>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="below">
                <h2 class="c_total">TOTAL :&nbsp;&nbsp;&nbsp;₱<?php echo $total; ?></h2>
                <button data-id="<?php echo $current['customer_id']; ?>" class="btnedit btnmain">NEXT CUSTOMER</button>
            </div>
        </div>
        <?php }else{ ?>
        <h1>NO CUSTOMER</h1>
        <?php } ?>
    </div>
</main>
