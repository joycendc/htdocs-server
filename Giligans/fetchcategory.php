<?php
require_once("init.php");
if(mysqli_connect_errno()){
    die('error '.mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT id, name FROM category;");
$stmt->execute();
$stmt->bind_result($id, $name);

$category = array();

while($stmt->fetch()){
    $temp = array();
    $temp['id'] = $id;
    $temp['name'] = $name;

    array_push($category, $temp);
}
echo json_encode($category);

?>