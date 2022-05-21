<?php
require 'db.php';

$dbname = 'kI4akVA6Mv';
$dbuser = 'kI4akVA6Mv';
$dbpass = 'eQV5AziqCQ';
$dbhost = 'remotemysql.com';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$db = new db($dbhost, $dbuser, $dbpass, $dbname);
?>
