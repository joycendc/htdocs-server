<?php
$db = "queueapp";
$userdb = "root";
$passdb = "";
$host = "localhost";

$conn = mysqli_connect($host, $userdb, $passdb, $db);

if(!$conn){
    echo "Not Connected!";
}