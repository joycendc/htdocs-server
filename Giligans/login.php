<?php
require_once("init.php");
$user = $_POST["user"];
$pass = $_POST["pass"];

$query = "SELECT * FROM customer WHERE username LIKE '$user' AND password LIKE '$pass'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    echo "Login Success!";
}else {
    echo "Login Failed!";
}
?>