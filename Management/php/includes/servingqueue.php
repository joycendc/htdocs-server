<aside>
    <div id="reload" class="home">
        <div id="tableholder" class="table">
            <h1 class="head">Serving Queue</h1>
            <hr />
            <table class="table-header">
                <thead>
                    <tr>
                        <th class="sticky-header">Date</th>
                        <th class="sticky-header" colspan="2">Name</th>
                        <th class="sticky-header">Paid</th>
                        <th class="sticky-header">Remove</th>
                    </tr>
                </thead>
            </table>
            <?php
            $current_cid = 0;
            
            $conn->execute('SET sql_mode = ""');
            
            $current_customer = $db->query('SELECT id, customer_id, customer_name, date FROM orders WHERE status=1 GROUP BY customer_id ORDER BY id;')->fetchAll();
            if (!empty($current_customer)) {
                $current = [];
                $current = $current_customer[0];
                $current_cid = $current['customer_id'];
            }
            
            $conn->execute('SET sql_mode = ""');
            
            $customers = $db->query('SELECT date, customer_id, customer_name, status FROM orders WHERE customer_id!=? AND status=1 GROUP BY customer_id ORDER BY id;', $current_cid)->fetchAll();
            ?>
            <div class="overlay" id="dialog-container">
                <div class="popup">
                    <p class="popup_title"></p>
                    <div class="text-right">
                        <button class="dialog-btn btn-cancel" id="cancel">CANCEL</button>
                        <button class="dialog-btn btn-primary" id="confirm">OK</button>
                    </div>
                </div>
            </div>

            <div class="tablewrap">
                <table>
                    <tbody id="tbody">
                        <?php
                //var_dump($customers)
                if (!empty($customers)) {
                    foreach ($customers as $customer): ?>
                        <tr data-toggle="toggle" class="row">
                            <td data-id="<?php echo $customer['date']; ?>"><?php echo date('h:i A', strtotime($customer['date'])); ?></td>
                            <td colspan="2" data-id="<?php echo $customer['customer_name']; ?>"><?php echo $customer['customer_name']; ?></td>
                            <td><?php
                            if ($customer['status'] == 1) {
                                echo "<i class='fas fa-money-bill'></i>Paid";
                            } else {
                                echo "<button data-id='{$customer['customer_id']}' name='paid' class='paid'>Mark as Paid/button>";
                            }
                            ?>
                            </td>
                            <td><button data-id="<?php echo $customer['customer_id']; ?>" name="remove" class="btnedit">Done</button>
                            </td>
                        </tr>
                        <?php
                        
                        $conn->execute('SET sql_mode = ""');
                        
                        $orders = $db->query('SELECT note, item_name, price, qty, total FROM (SELECT id, note, item_name, price, SUM(qty) AS qty, SUM(total) AS total FROM orders WHERE customer_id=? GROUP BY item_name) orders;', $customer['customer_id'])->fetchAll();
                        ?>
                    <tbody class="hide">
                        <tr class="rowhead note">
                            <td colspan="5">--- <?php echo $orders[0]['note']; ?> ---</td>
                        </tr>
                        <tr class="rowhead">
                            <td colspan="2"><?php echo 'Item'; ?></td>
                            <td><?php echo 'Price'; ?></td>
                            <td><?php echo 'Qty'; ?></td>
                            <td><?php echo 'Total'; ?></td>
                        </tr>
                        <?php
                    $total = 0;
                    foreach ($orders as $order): 
                        $total += $order['total'];
                    ?>
                        <tr class="dt">
                            <td colspan="2"><?php echo $order['item_name']; ?></td>
                            <td><?php echo $order['price']; ?></td>
                            <td><?php echo $order['qty']; ?></td>
                            <td>&nbsp;&nbsp;<?php echo $order['total']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="rowhead total">
                            <td colspan="3">TOTAL</td>
                            <td>₱</td>
                            <td> <?php echo $total; ?></td>
                        </tr>
                    </tbody>
                    <?php endforeach;
                } ?>
                    </tbody>
                </table>
                <?php if(sizeof($customers) == 0){ ?>
                <h1 class="center">NO CUSTOMER</h1>
                <?php } ?>
            </div>
        </div>
    </div>
</aside>
