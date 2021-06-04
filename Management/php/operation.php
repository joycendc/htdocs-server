<?php



if(!function_exists('db')){
    function db(){
        require "db.php";
        return $conn;
    }
}

// get data from mysql database
function getData($query){
    require "db.php";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows > 0){
        return $stmt;
    }

}

?>