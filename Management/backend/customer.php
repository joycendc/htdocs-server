<?php
require '../php/init.php';

if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$number = $_POST['number'];
	
        if ($db->query("INSERT INTO customer (first_name, last_name, mobile_number) VALUES ('$fname', '$lname', '$number');")) {
            $db->close();
            echo json_encode(array("statusCode" => 200));
		}  else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
   if( $_POST['type'] == 2){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $number = $_POST['number'];

		if ($db->query("UPDATE customer SET `first_name`='$fname', `last_name`='$lname', `mobile_number`='$number' WHERE id=$id;")) {
			$db->close();
			echo json_encode(array("statusCode" => 200));
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
   }

   if ($_POST['type'] == 3) {
    $id = $_POST['id'];
   
    if ($db->query("DELETE FROM customer WHERE id=$id;")) {
        $db->close();
        echo $id;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

}

?>