<?php
require_once("init.php");
$query = $_GET['query'];

if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT id, name, description, price, prep_time, cat_id, url FROM items WHERE name LIKE '%$query%';");
$stmt->execute();
$stmt->bind_result($id, $name, $description, $price, $prep_time, $cat_id, $url);

$item = array();

while($stmt->fetch()){
    $temp = array();
    $temp['id'] = $id;
    $temp['name'] = $name;
    $temp['description'] = $description;
    $temp['price'] = $price;
    $temp['prep_time'] = $prep_time;
    $temp['cat_id'] = $cat_id;
    $temp['url'] = $url;

    array_push($item, $temp);
}
echo json_encode($item);

?>