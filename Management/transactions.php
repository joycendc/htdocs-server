<?php
    // require "./php/operation.php";
    require "./php/init.php";

    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="./styles/fontawesome.min.css">
	<link rel="stylesheet" href="./styles/bootstrap.min.css">
	<link rel="stylesheet" href="./styles/style.css">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/ajax.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>
<body>
<div class="containers">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Recent Orders</b></h2>
					</div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>		
                            <th>ID</th>
                            <th>DATE OF TRANSACTION</th>
                            <th>QUEUE ID</th>
                            <th>CUSTOMER ID</th>
                            <th>CUSTOMER NAME</th>
                            <th>ITEM NAME</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    $orders = $db->query("SELECT * FROM transactions;")->fetchAll();
                    
                    if (!empty($orders)) {
                        foreach ($orders as $order){
                    ?>
                    <tr id="<?php echo $order["id"]; ?>">
                        <td><?php echo $order["id"]; ?></td>
                        <td><b><?php echo $order["date"]; ?></b></td>			
                        <td><?php echo $order["queue_id"]; ?></td>
                        <td><?php echo $order["customer_id"]; ?></td>
                        <td><?php echo $order["customer_name"]; ?></td>
                        <td><?php echo $order["item_name"]; ?></td>
                        <td><?php echo $order["qty"]; ?></td>
                        <td><?php echo $order["price"]; ?></td>
                        <td><b><?php echo $order["total"]; ?></b></td>
                        
                    </tr>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
			</div>
        </div>
    </div>
	
</body>
</html>