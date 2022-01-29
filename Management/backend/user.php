<?php
require '../php/init.php';

if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
		$username = $_POST['username'];
		$level = $_POST['level'];
	
		if ($db->query("INSERT INTO users (username, level) VALUES ('$username', '$level');")) {
            $db->close();
            echo json_encode(array("statusCode" => 200));
		}  else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
   if( $_POST['type'] == 2){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $level = $_POST['level'];

		if ($db->query("UPDATE users SET `username`='$username', `level`='$level' WHERE id=$id;")) {
			$db->close();
			echo json_encode(array("statusCode" => 200));
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
   }

   if ($_POST['type'] == 3) {
    $id = $_POST['id'];
   
    if ($db->query("DELETE FROM users WHERE id=$id;")) {
        $db->close();
        echo $id;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

}

?>