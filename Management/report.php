<?php
// require "./php/operation.php";
require "./php/init.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recent Orders</title>
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/jquery-ui.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ajax.js"></script>
   
</head>

<body>
    <?php
        include('./php/includes/navbar.php');
    ?>
    <div class="table-wrapper">
        <div class="table-title"> 
            <div class="row">
                <div class="col-sm-6">
                    <h2><b>Sales Report</b></h2>
                </div>
            
            </div>
            
        </div>	
        <div class="col-md-3">
            <label for="from_date">
                FROM
            </label>
            <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control" />
        </div>
        <div class="col-md-3">
            <label for="from_date">
                TO
            </label>
            <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control" />
        </div>
        <div class="col-md-5">
            <br>
            <button type="button" class="btn btn-primary" onclick="window.location.reload();">RESET</button>
        </div>
        <div style="clear: both;"></div>
        <br>
        <div id="order_table">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>DATE</th>  
                        <th>TOTAL</th>
                    </tr>
                <?php 
                $orders = $db->query("SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d');")->fetchAll();

                if (!empty($orders)) {
                    foreach ($orders as $order) {
                ?>
                    <tr>
                        <td><b><?php echo $order["date"]; ?></b></td>
                        <td><b><?php echo $order["total"]; ?></b></td>
                    </tr>
                <?php
                    }
                }
                ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                maxDate: 0,
            });
            $(function () {
                $("#from_date").datepicker({
                    onSelect: function() {
                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        if(from_date != '' && to_date != ''){
                            $.ajax({
                                url: './php/report.php',
                                method: "POST",
                                data: { from_date: from_date, to_date: to_date},
                                success: function(data){
                                    $('#order_table').html(data);
                                }
                            });
                        }
                    }
                });

                $("#to_date").datepicker({
                    onSelect: function() {
                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        if(from_date != '' && to_date != ''){
                            $.ajax({
                                url: './php/report.php',
                                method: "POST",
                                data: { from_date: from_date, to_date: to_date},
                                success: function(data){
                                    $('#order_table').html(data);
                                }
                            });
                        }else {
                            alert("Please Select a date range first !");
                        }
                    }
                });
            });
            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' && to_date != ''){
                    $.ajax({
                        url: './php/report.php',
                        method: "POST",
                        data: { from_date: from_date, to_date: to_date},
                        success: function(data){
                            $('#order_table').html(data);
                        }
                    });
                }else {
                    alert("Please Select a date range first !");
                }
            })
        })
    </script>
</body>
</html>
