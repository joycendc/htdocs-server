<main id="viewholder">
<div class="view">
    <?php      
    
    if (!empty($current_customer)) {              
    
    ?>
    <img class="avatar" src="./images/img_avatar.png" alt="Avatar"> 
    <h2><?php echo $current['customer_name']; ?></h2>
    <h3><?php echo date("F d Y - h:i A", strtotime($current['date'])); ?></h3> 
    <div class="list">
        <li class="orders">
            <?php      
            $total = 0;            
            $orders = $db->query("SELECT item_name, price, qty, total FROM (SELECT item_name, price, SUM(qty) AS qty, SUM(total) AS total FROM orders WHERE customer_id=? GROUP BY item_name) orders;", $current['customer_id'])->fetchAll(); 
            foreach ($orders as $order): 
                $total += $order['total'];
                $getitem = $db->query("SELECT url FROM items WHERE name=?;", $order['item_name'])->fetchAll(); 
            
                $item = $getitem[0]['url']; ?>
            <ul class="item"><img class="fooImg" src="../Giligans/images/<?php echo $item; ?>" alt="Food"/><h2><?php echo $order['qty']; ?></h2><h2>₱<?php echo $order['total']; ?></h2>
            <h2><?php echo $order['item_name']; ?></h2></ul>                                                                                                                                                 
            <?php endforeach; ?>    
        </li>
        <h2 class="c_total">TOTAL :&nbsp;&nbsp;&nbsp;₱<?php echo $total; ?></h2>
        
        <button data-id="<?php echo $current['customer_id']; ?>" class="btnedit btnmain">NEXT CUSTOMER</button>
    </div>
    <?php }else{ ?>
        <h1>NO CUSTOMER</h1>
    <?php } ?>
</div>
</main>