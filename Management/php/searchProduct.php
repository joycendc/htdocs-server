<?php
    require "init.php";

    $value = $_POST['value'];
    $limit = 10;
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    if(!isset($_POST['value']) || $value == ""){
        $products = $db->query("SELECT i.id, i.name, i.description, i.price, i.url, i.cat_id, c.name AS cat FROM items i JOIN category c ON c.id = i.cat_id ORDER BY ID DESC LIMIT $start, $limit;")->fetchAll();
    }else{
        $products = $db->query("SELECT i.id, i.name, i.description, i.price, i.url, i.cat_id, c.name AS cat FROM items i JOIN category c ON c.id = i.cat_id WHERE i.name LIKE CONCAT( '%',?,'%') OR i.description LIKE CONCAT( '%',?,'%') OR i.price LIKE CONCAT( '%',?,'%') LIMIT $start, $limit;", [$value, $value, $value])->fetchAll();
    }

    $dynamicMakeTbl = '<table class="table table-striped table-hover">';

    $dynamicMakeTbl .= '<thead>';
    $dynamicMakeTbl .= '<tr>';
    $dynamicMakeTbl .= '<th></th>';
    $dynamicMakeTbl .= '<th>IMAGE</th>';
    $dynamicMakeTbl .= '<th>NAME</th>';
    $dynamicMakeTbl .= '<th>DESCRIPTION</th>';
    $dynamicMakeTbl .= '<th>PRICE</th>';
    $dynamicMakeTbl .= '<th>CATEGORY</th>';
    $dynamicMakeTbl .= '<th>ACTION</th>';
    $dynamicMakeTbl .= '</tr>';
    $dynamicMakeTbl .= '</thead>';
    $dynamicMakeTbl .= '<tbody>';

    //echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
    $imagePath = "../API/images/";
    if (!empty($products)) {
        foreach ($products as $product) {
            $image = $product["url"];
            $id = $product["id"];
            $name = $product["name"]; 
            $desc = $product["description"];
            $price = $product["price"];
            $cat = $product["cat"];

            $dynamicMakeTbl .= '<tr id="'.$id.'">';
            $dynamicMakeTbl .= '<td></td>';
            $dynamicMakeTbl .= '<td><img class="foodImg" src="'.$imagePath.$image.'" alt="Food" /></td>';
            $dynamicMakeTbl .= '<td><b>'.$name.'</b></td>';
            $dynamicMakeTbl .= '<td style="overflow: hidden;max-width: 40ch;"><b>'.$desc.'</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$price.'</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$cat.'</b></td>';
            $dynamicMakeTbl .= '<td><a href="#editProductModal" class="edit" data-toggle="modal">';
            $dynamicMakeTbl .= '<i class="fas fa-edit update" data-toggle="tooltip" data-id="'.$id.'" data-name="'.$name.'" data-desc="'.$desc.'" data-price="'.$price.'" data-cat="'.$cat.'" title="Edit"></i></a>';
            $dynamicMakeTbl .= '<a href="#deleteProductModal" class="delete" data-id="'.$id.'" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>';
            $dynamicMakeTbl .= '</tr>';	
        }
        $dynamicMakeTbl .= '</tbody>';

        $dynamicMakeTbl .= '</table>';

        echo $dynamicMakeTbl;
    }

   