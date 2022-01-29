<aside>
<div id="reload" class="home">    
    <div id="tableholder" class="table">
    <h1 class="head">Payment Queue</h1>
    <hr/>
        <?php       
            $customers = $db->query("SELECT date, customer_id, customer_name, status FROM orders WHERE status=0 GROUP BY customer_id ORDER BY id;")->fetchAll();
        ?>         
        <div class="tablewrap"> 
        <table >
            <thead>
                <tr>      
                    <th>Date</th>
                    <th colspan="2">Name</th>
                    <th >Paid</th> 
                    <th>Remove</th>                 
                </tr>
            </thead>
            <tbody id="tbody" >
              <?php
              
              if (!empty($customers)) {
                  foreach ($customers as $customer): ?>
              <tr data-toggle="toggle" class="row">   
                  <td data-id="<?php echo $customer['date']; ?>"><?php echo date("h:i A", strtotime($customer['date'])); ?></td>                                                
                  <td colspan="2" data-id="<?php echo $customer['customer_name']; ?>"><?php echo $customer['customer_name']; ?></td>   
                  <td ><?php 
                    if($customer['status'] == 1){
                        echo "PAID";
                    }else{
                       echo "<button data-id='{$customer['customer_id']}' name='paid' class='paid'><i class='fas fa-money-bill'></i>MARK</button>";
                    }
                    ?>
                  </td>  
                  <td><button data-id="<?php echo $customer['customer_id']; ?>" name="remove" class="btnedit"><i class='fas fa-check-circle'></i>DONE</button></td>
              </tr>
              <?php
                 $orders = $db->query("SELECT note, item_name, price, qty, total, type FROM (SELECT note, item_name, price, SUM(qty) AS qty, SUM(total) AS total, type FROM orders WHERE customer_id=? GROUP BY item_name) orders;", $customer['customer_id'])->fetchAll();
              ?>
              <tbody class="hide">                  
                  <tr class="rowhead note"><td colspan="5"><?php echo $orders[0]['type'] === 1 ? "DINE IN" : "TAKE OUT"; ?> :  <?php echo !empty($orders[0]['note']) ? $orders[0]['note'] : "---"; ?></td></tr>
                  <tr class="rowhead">                                                                                                                      
                      <td colspan="2" ><?php echo "Item"; ?></td>    
                      <td><?php echo "Price"; ?></td>                                                                                                   
                      <td><?php echo "Qty"; ?></td>                                                                                                                      
                      <td><?php echo "Total"; ?></td>                                                                                                                       
                  </tr>
                  
                  <?php
                    $total = 0;
                    foreach ($orders as $order): 
                    $total += $order['total'];
                  ?>
                  <tr class="dt">                                                                                                                   
                      <td colspan="2"> <?php echo $order['item_name']; ?></td>  
                      <td><?php echo $order['price']; ?></td>  
                      <td><?php echo $order['qty']; ?></td>  
                      <td>&nbsp;&nbsp;<?php echo $order['total']; ?></td>                                                                                                                                                 
                  </tr>
                  <?php endforeach; ?>
                  <tr class="rowhead total">
                      <td colspan="3" >TOTAL</td>
                      <td>PHP</td>
                      <td>&nbsp;&nbsp;<?php echo $total; ?></td>  
                  </tr>       
              </tbody>         
              <?php endforeach;
              } $db->close(); ?>    
            </tbody>     
        </table>
        <?php if(sizeof($customers) == 0){ ?>
            <h1 class="center">NO CUSTOMER</h1>
        <?php } ?>
        </div>    
    </div>
</div>
</aside>