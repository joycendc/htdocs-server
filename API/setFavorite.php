<?php
require_once("init.php");

$customer_id = $_POST['customer_id'];
$item_id = $_POST['item_id'];
$response = array();
if(isset($_POST['fave'])){
    switch ($_POST['fave']) {
        case 'check':
            $stmt = $conn->prepare("SELECT * FROM favorites WHERE customer_id=? AND item_id=?;");
            $stmt->bind_param("ss", $customer_id, $item_id);
            $stmt->execute();
            $stmt->store_result();  

            if($stmt->num_rows > 0){
                $response['error'] = false;
                $response['status'] = 'true';
                $stmt->close();
            }else{
                $response['error'] = false;
                $response['status'] = 'false';
                $stmt->close();
            }
        break;
        case 'add':
            $stmt = $conn->prepare("INSERT INTO favorites (customer_id, item_id) VALUES (?, ?);");
            $stmt->bind_param("ss", $customer_id, $item_id);

            if ($stmt->execute()) {
                $response['error'] = false;
                $response['status'] = 'Added to Favorites';
                $stmt->close();
            }else{
                $response['error'] = true;
                $response['status'] = 'Existing';
                $stmt->close();
            }

        break;
        case 'remove':
            $stmt = $conn->prepare("DELETE FROM favorites WHERE customer_id=? AND item_id=?;");
            $stmt->bind_param("ss", $customer_id, $item_id);

            if ($stmt->execute()) {
                $response['error'] = false;
                $response['status'] = 'Removed from Favorites';
                $stmt->close();
            }else{
                $response['error'] = true;
                $response['status'] = 'Err';
                $stmt->close();
            }
        break;
        case 'fetch':
            $stmt = $conn->prepare("SELECT i.id, i.name, i.description, i.price, i.cat_id, i.url
                                    FROM items i
                                    INNER JOIN favorites f ON i.id = f.item_id
                                    INNER JOIN customer c ON f.customer_id = c.id
                                    WHERE c.id = ?;");
            $stmt->bind_param("s", $customer_id);
            $stmt->execute();
            $stmt->bind_result($id, $name, $description, $price, $cat_id, $url);

            $item = array();

            while($stmt->fetch()){
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['description'] = $description;
                $temp['price'] = $price;
                $temp['cat_id'] = $cat_id;
                $temp['url'] = $url;

                array_push($item, $temp);
            }
            $response = $item;
            $stmt->close();
        break;
    }
    
}
echo json_encode($response);
