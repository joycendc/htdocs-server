<?php
require '../php/init.php';

if(count($_POST)>0){
	if($_POST['type']==1){
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$price = $_POST['price'];
		$cat_id = $_POST['cat'];
		$url = strtolower(preg_replace("/\s+/", "", $name)).".png";

		

        if ($db->query("INSERT INTO items (name, description, price, cat_id, url) VALUES ('$name', '$desc', '$price', '$cat_id', '$url');")) {
            /* Get the name of the uploaded file */
			$filename = $_FILES['image']['name'];

			/* Choose where to save the uploaded file */
			$location =  $_SERVER['DOCUMENT_ROOT'] . "/Giligans/images/" . $url;

			/* Save the uploaded file to the local filesystem */
			if (move_uploaded_file($_FILES['image']['tmp_name'], $location) ) { 
				$db->close();
				echo json_encode(array("statusCode"=>200));
			} else { 
				echo 'Failure'; 
			}
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
			$db->close();
			echo json_encode(array("statusCode"=>200)); 
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		if ($db->query("DELETE FROM items WHERE id=$id;")){
			echo $id;
            $db->close();
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
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