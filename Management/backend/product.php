<?php
require '../php/init.php';

if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		$desc=$_POST['desc'];
		$price=$_POST['price'];
		$cat_id=$_POST['cat'];

        if ($db->query("INSERT INTO items (name, description, price, cat_id) VALUES ('$name','$desc','$price','$cat_id');")) {
            echo json_encode(array("statusCode"=>200));
            $db->close();
        }else {
            echo "Error: " . $sql . "<br>";
        }
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
        $id=$_POST['id'];
		$name=$_POST['name'];
		$desc=$_POST['desc'];
		$price=$_POST['price'];
		$cat_id=$_POST['cat'];

		if ($db->query("UPDATE items SET `name`='$name',`description`='$desc',`price`='$price',`cat_id`='$cat_id' WHERE id=$id;")){
			echo json_encode(array("statusCode"=>200));
            $db->close();
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `crud` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM crud WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>