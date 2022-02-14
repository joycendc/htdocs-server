<?php
    require "init.php";

    $value = $_POST['value'];
    $limit = 10;
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    if(!isset($_POST['value']) || $value == ""){
        $users = $db->query("SELECT id, username, level FROM users ORDER BY ID DESC LIMIT $start, $limit;")->fetchAll();
    }else{
        $users = $db->query("SELECT id, username, level FROM users WHERE username LIKE CONCAT( '%',?,'%') LIMIT $start, $limit;", [$value])->fetchAll();
    }

    $dynamicMakeTbl = '<table class="table table-striped table-hover">';

    $dynamicMakeTbl .= '<thead>';
    $dynamicMakeTbl .= '<tr>';
    $dynamicMakeTbl .= '<th></th>';
    $dynamicMakeTbl .= '<th>USERNAME</th>';
    $dynamicMakeTbl .= '<th>LEVEL</th>';
    $dynamicMakeTbl .= '<th>ACTION</th>';
    $dynamicMakeTbl .= '</tr>';
    $dynamicMakeTbl .= '</thead>';
    $dynamicMakeTbl .= '<tbody>';


    if (!empty($users)) {
        foreach ($users as $user) {
            $id = $user["id"];
            $username = $user["username"];
            $level = $user["level"]; 
           

            $dynamicMakeTbl .= '<tr id="'.$id.'">';
            $dynamicMakeTbl .= '<td></td>';
            $dynamicMakeTbl .= '<td><b>'.$username.'</b></td>';
            $dynamicMakeTbl .= '<td><b>'.$level.'</b></td>';
            $dynamicMakeTbl .= '<td><a href="#editUserModal" class="edit" data-toggle="modal">';
            $dynamicMakeTbl .= '<i class="fas fa-edit userUpdate" data-toggle="tooltip" data-id="'.$id.'" data-username="'.$username.'" data-level="'.$level.'" title="Edit"></i></a>';
            $dynamicMakeTbl .= '<a href="#deleteUserModal" class="userDelete" data-id="'.$id.'" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>';
            $dynamicMakeTbl .= '</tr>';	
        }
        $dynamicMakeTbl .= '</tbody>';

        $dynamicMakeTbl .= '</table>';

        echo $dynamicMakeTbl;
    }

   