

<nav class="nav">
    <div class='logo'>
        <a href="http://localhost/Management/">FoodQueue</a>
    </div>
    <ul class="links">
        <li><a 
            <?php 
        
            if($_SERVER['SCRIPT_NAME'] == "/Management/queuing.php") { ?>
                class="active"
                <?php } ?>
            href="./queuing.php">QUEING</a></li>
        <li ><a
            <?php 
            echo $_SERVER['SCRIPT_NAME'];
            if($_SERVER['SCRIPT_NAME'] == "/Management/management.php") { ?>
                class="active"
                <?php } ?>
             href="./management.php">MANAGEMENT</a></li>
        <li><a 
            <?php 
            echo $_SERVER['SCRIPT_NAME'];
            if($_SERVER['SCRIPT_NAME'] == "/Management/transactions.php") { ?>
                class="active"
                <?php } ?>
            href="./transactions.php">RECENT ORDERS</a></li>
        <li><a href="./logout.php"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>      
    </ul>
</nav>
