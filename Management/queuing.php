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
    <title>Customer Queue</title>
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" type="text/css" href="./styles/queuing.css">
</head>

<body>
    <?php
        include('./php/includes/navbar.php');
    ?>
    <div class="content">
        <?php
        include('./php/includes/servingqueue.php');
        include('./php/includes/currentcustomer.php');
        include('./php/includes/paymentqueue.php');
        ?>
    </div>
    <script src="./js/jquery.js"></script>
    <script src="./js/main.js"></script>
</body>
<script>
   function logout(e) {
      e.preventDefault();
      alert(1);
   }

</script>

</html>