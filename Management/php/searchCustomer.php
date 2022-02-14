<?php
    require "init.php";

    $value = $_POST['value'];
    $limit = 10;
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    if(!isset($_POST['value']) || $value == ""){
        $customers = $db->query("SELECT id, first_name, last_name, mobile_number FROM customer ORDER BY ID DESC LIMIT $start, $limit;")->fetchAll();
    }else{
        $customers = $db->query("SELECT id, first_name, last_name, mobile_number FROM customer WHERE first_name LIKE CONCAT( '%',?,'%') OR last_name LIKE CONCAT( '%',?,'%') OR mobile_number LIKE CONCAT( '%',?,'%') LIMIT $start, $limit;", [$value, $value, $value])->fetchAll();
    }

    $dynamicMakeTbl = '<table class="table table-striped table-hover">';

    $dynamicMakeTbl .= '<thead>';
    $dynamicMakeTbl .= '<tr>';
    $dynamicMakeTbl .= '<th></th>';
    $dynamicMakeTbl .= '<th>FIRST NAME</th>';
    $dynamicMakeTbl .= '<th>LAST NAME</th>';
    $dynamicMakeTbl .= '<th>MOBILE NUMBER</th>';
    $dynamicMakeTbl .= '<th>ACTION</th>';
    $dynamicMakeTbl .= '</tr>';
    $dynamicMakeTbl .= '</thead>';
    $dynamicMakeTbl .= '<tbody>';

    //echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
    $imagePath = "../API/images/";
    if (!empty($customers)) {
        foreach ($customers as $customer) {
            $id = $customer["id"];
            $first_name = $customer["first_name"];
            $last_name = $customer["last_name"]; 
            $mobile_number = $customer["mobile_number"];
           

            $dynamicMakeTbl .= '<tr id="'.$id.'">';
            $dynamicMakeTbl .= '<td></td>';
            $dynamicMakeTbl .= '<td><b>'.$first_name.'</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$last_name.'</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$mobile_number.'</b></td>';
            $dynamicMakeTbl .= '<td><a href="#editCustomerModal" class="edit" data-toggle="modal">';
            $dynamicMakeTbl .= '<i class="fas fa-edit customerUpdate" data-toggle="tooltip" data-id="'.$id.'" data-first_name="'.$first_name.'" data-last_name="'.$last_name.'" data-mobile_number="'.$mobile_number.'" title="Edit"></i></a>';
            $dynamicMakeTbl .= '<a href="#deleteCustomerModal" class="customerDelete" data-id="'.$id.'" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>';
            $dynamicMakeTbl .= '</tr>';	
        }
        $dynamicMakeTbl .= '</tbody>';

        $dynamicMakeTbl .= '</table>';

        echo $dynamicMakeTbl;
    }

   