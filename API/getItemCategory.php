<?php
require_once("init.php");
$id = $_GET['id'];

if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT id, name, description, price, url FROM items WHERE cat_id='$id';");
$stmt->execute();
$stmt->bind_result($id, $name, $description, $price, $url);

$item = array();

while($stmt->fetch()){
    $temp = array();
    $temp['id'] = $id;
    $temp['name'] = $name;
    $temp['description'] = $description;
    $temp['price'] = $price;
    $temp['url'] = $url;

    array_push($item, $temp);
}
echo json_encode($item);

?>