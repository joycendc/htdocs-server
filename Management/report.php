<?php
// require "./php/operation.php";
require './php/init.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="192x192" href="../../src/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../src/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../src/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../src/favicon-16x16.png">
    <link rel="manifest" href="../../src/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../src/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Report</title>
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/jquery-ui.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ajax.js"></script>
    <script src="./js/chart.min.js"></script>

</head>
<style>

</style>

<body>
    <?php
    include './php/includes/navbar.php';
    ?>
    <?php if($_SESSION['level'] && $_SESSION['level'] == '2'){ ?>
    <div class="table-wrapper" style="height: 85vh;">
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
        <div class="chart-container" style="height:35vh; width:55vw;">
            <canvas id="myChart"></canvas>
        </div>
        <!--
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>DATE</th>
                        <th>TOTAL</th>
                    </tr>
                <?php 

                $conn->query('SET sql_mode = ""');


                $orders = $db->query("SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d');")->fetchAll();

                if (!empty($orders)) {
                    foreach ($orders as $order) {
                ?>
                    <tr>
                        <td><b><?php echo $order['date']; ?></b></td>
                        <td><b><?php echo $order['total']; ?></b></td>
                    </tr>
                <?php
                    }
                }
                ?>
                </table>
            </div>
            -->
    </div>
    <?php } else { ?>
    <h1 class="text-center">No access</h1>
    <?php } ?>
    <script src="./js/report.js"></script>
</body>

</html>
