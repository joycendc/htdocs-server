<?php
    require "init.php";

    if(isset($_POST['from_date'], $_POST['to_date'])){
        $reports = $db->query("SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions WHERE (DATE(date) BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."') GROUP BY DATE_FORMAT(date,'%Y-%M-%d');")->fetchAll();
    }
    
    $dynamicMakeTbl = '<table class="table table-striped table-hover">';

        $dynamicMakeTbl .= '<thead>';
        $dynamicMakeTbl .= '<tr>';
        $dynamicMakeTbl .= '<th>DATE</th>';
        $dynamicMakeTbl .= '<th>TOTAL</th>';
        $dynamicMakeTbl .= '</tr>';
        $dynamicMakeTbl .= '</thead>';
        $dynamicMakeTbl .= '<tbody>';
    

        if (!empty($reports)) {
            $overall = 0;
            
            foreach ($reports as $report) {
                $id = $report["id"]; 
                $date = explode(" ", $report["date"])[0]; 
                $total = $report["total"]; 
                
                $overall = $overall + $total;

                $dynamicMakeTbl .= '<tr id="'.$id.'">';
             
                $dynamicMakeTbl .= '<td><b>'.$date.'</b></td>';
                $dynamicMakeTbl .= '<td><b>'.$total.'</b></td>';
                $dynamicMakeTbl .= '</tr>';	
            }

            $dynamicMakeTbl .= '<tr id="'.$id.'">';
             
            $dynamicMakeTbl .= '<td><b>TOTAL</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$overall.'</b></td>';
            $dynamicMakeTbl .= '</tr>';	

            $dynamicMakeTbl .= '</tbody>';
    
            $dynamicMakeTbl .= '</table>';
    
            echo $dynamicMakeTbl;
        }else {
            echo '<h1 class="text-center">No Data Found...</h1>';
        }
   