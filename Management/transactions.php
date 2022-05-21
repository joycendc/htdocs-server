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
    <title>Transactions</title>
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ajax.js"></script>
    <style>
        table tbody tr {
            cursor: pointer;
        }

        .orders {
            height: 75%;
            width: 100%;
            overflow-y: auto;
            font-weight: bold;
            color: #fff;
            /* display: inline-block;  */
            text-align: center;
            padding: 0 10px;
            padding-right: 5px;
            font-size: 12px;
            list-style: none;
        }

        .item {
            display: flex;
            align-items: center;
            width: 100%;
            height: auto;
            border-radius: 5px;
            display: flex;
            align-items: center;
            text-align: center;
            font-size: 0.5em;
            padding: 0 10px;
            background: rgb(240, 243, 242);
            margin-bottom: 5px;
            color: var(--accent);
        }

        .item h2 {
            flex: 1;
            font-size: 12px;
        }

        .modal-body {
            text-align: center;
        }

        .header {
            color: #000;
            padding-bottom: 10px;
        }

    </style>
</head>

<body>
    <?php
    include './php/includes/navbar.php';
    ?>
    <?php if($_SESSION['level'] && $_SESSION['level'] == '2'){ ?>
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
                            <th></th>
                            <th>QUEUE ID</th>
                            <th>CUSTOMER NAME</th>
                            <th>DATE OF TRANSACTION</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $limit = 10;
                            $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
                            $start = ($page - 1) * $limit;

                            $orders = $db->query("SET sql_mode = ''; SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d %H:%i') LIMIT $start, $limit;")->fetchAll();
                            //$orders = $db->query("SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d %H:%i');")->fetchAll();
                            
                            $sql = $db->query("SET sql_mode = ''; SELECT count(id) AS id FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d %H:%i');")->fetchAll();
                            $allRecrods = sizeOf($sql);
                            // Calculate total pages
                            $totalPages = ceil($allRecrods / $limit); 
           
                            // Prev + Next
                            $prev = $page - 1;
                            $next = $page + 1;

                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                            ?>
                        <a href="#showOrderModal" class="info" data-toggle="modal">
                            <tr class='order' data-target="#showOrderModal" data-toggle="tooltip"
                                data-id="<?php echo $order['queue_id']; ?>" data-name="<?php echo $order['customer_name']; ?>"
                                data-date="<?php echo $order['date']; ?>" id="<?php echo $order['id']; ?>">
                                <td></td>
                                <td><b><?php echo $order['queue_id']; ?></b></td>
                                <td><b><?php echo $order['customer_name']; ?></b></td>
                                <td><b><?php echo $order['date']; ?></b></td>
                                <td><b><?php echo $order['total']; ?></b></td>
                            </tr>
                            </tr>
                        </a>
                        <?php
                                }
                            }
                            ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1) {
                            echo 'disabled';
                        } ?>">
                            <a class="page-link" href="<?php if ($page <= 1) {
                                echo '#';
                            } else {
                                echo '?page=' . $prev;
                            } ?>">Previous</a>
                        </li>

                        <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                        <li class="page-item <?php if ($page == $i) {
                            echo 'active';
                        } ?>">
                            <a class="page-link" href="transactions.php?page=<?= $i ?>"> <?= $i ?> </a>
                        </li>
                        <?php endfor; ?>

                        <li class="page-item <?php if ($page >= $totoalPages) {
                            echo 'disabled';
                        } ?>">
                            <a class="page-link" href="<?php if ($page >= $totoalPages) {
                                echo '#';
                            } else {
                                echo '?page=' . $next;
                            } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <h1 class="text-center">No access</h1>
    <?php } ?>

    <div id="showOrderModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Orders</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="header">
                    </div>
                    <ul class="orders">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
