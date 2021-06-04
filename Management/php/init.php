<?php
require "db.php";

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'queueapp';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);
?>