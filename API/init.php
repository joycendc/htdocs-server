<?php
$db = 'kI4akVA6Mv';
$userdb = 'kI4akVA6Mv';
$passdb = 'eQV5AziqCQ';
$host = 'remotemysql.com';

$conn = mysqli_connect($host, $userdb, $passdb, $db);

if (!$conn) {
    echo 'Not Connected!';
}
