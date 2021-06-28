<aside>
<div id="reload" class="home">    
    <div id="tableholder" class="table">
    <h1 class="head">Serving Queue</h1>
    <hr>
        <?php    
            $current_cid = 0; 
            $current_customer = $db->query("SELECT id, customer_id, customer_name, date FROM orders WHERE status=1 GROUP BY customer_id ORDER BY id;")->fetchAll();     
            if (!empty($current_customer)) {
                $current = array();
                $current = $current_customer[0];
                $current_cid = $current['customer_id'];
            }

            $customers = $db->query("SELECT date, customer_id, customer_name, status FROM orders WHERE customer_id!=? AND status=1 GROUP BY customer_id ORDER BY id;", $current_cid)->fetchAll();
        ?>         
        <div class="tablewrap"> 
        <table>
            <thead>
                <tr>    
                    <th colspan="2" >Date</th>
                    <th colspan="2" >Name</th>
                    <th>Status</th> 
                    <th>Done</th>              
                </tr>
            </thead>
            <tbody id="tbody">
              <?php
              //var_dump($customers)
              if (!empty($customers)) {
                  foreach ($customers as $customer): ?>
              <tr data-toggle="toggle" class="row"> 
                  <td colspan="2" data-id="<?php echo $customer['date']; ?>"><?php echo date("M d-h:i A", strtotime($customer['date'])); ?></td>                                                   
                  <td colspan="2" data-id="<?php echo $customer['customer_name']; ?>"><?php echo $customer['customer_name']; ?></td>   
                  <td><?php 
                    if($customer['status'] == 1){
                        echo "Paid";
                    }else{
                       echo "<button data-id='{$customer['customer_id']}' name='paid' class='paid'>Mark as Paid/button>";
                    }
                    ?>
                    </td>  
                  <td><button data-id="<?php echo $customer['customer_id']; ?>" name="remove" class="btnedit">Done</button></td>
              </tr>
              <tbody class="hide">
                  <!-- <tr class="rowhead"><td></td><td colspan="3">ORDERS</td></tr> -->
                  <tr class="rowhead">                                                                                                                      
                      <td colspan="3" ><?php echo "Item"; ?></td>    
                      <td><?php echo "Price"; ?></td>                                                                                                   
                      <td><?php echo "Qty"; ?></td>                                                                                                                       
                      <td><?php echo "Total"; ?></td>                                                                                                                       
                  </tr>
                  <?php
                  $total = 0;
                  $orders = $db->query("SELECT item_name, price, qty, total FROM (SELECT item_name, price, SUM(qty) AS qty, SUM(total) AS total FROM orders WHERE customer_id=? GROUP BY item_name) orders;", $customer['customer_id'])->fetchAll();
                  foreach ($orders as $order): 
                    $total += $order['total'];
                  ?>
                  <tr class="dt">                                                                                                                   
                      <td colspan="3" ><?php echo $order['item_name']; ?></td>  
                      <td><?php echo $order['price']; ?></td>  
                      <td><?php echo $order['qty']; ?></td>  
                      <td>&nbsp;&nbsp;<?php echo $order['total']; ?></td>                                                                                                                                                 
                  </tr>
                  <?php endforeach; ?>
                  <tr class="rowhead total"><td colspan="4" >TOTAL</td><td>₱</td><td> <?php echo $total; ?></td>  </tr>       
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