<?php
require_once("init.php");

$response = array();
if(isset($_GET['apicall'])){
    switch($_GET['apicall']){
        case 'signup':
            if(isTheseParametersAvailable(array('fname','lname','mobile'))){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $mobile = $_POST['mobile'];   

                $stmt = $conn->prepare("SELECT id FROM customer WHERE mobile_number=?;");
                $stmt->bind_param("s", $mobile);
                $stmt->execute();
                $stmt->store_result();  

                if($stmt->num_rows > 0){
                    $response['error'] = true;
                    $response['message'] = 'User already registered';
                    $stmt->close();
                }else{
                    $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, mobile_number) VALUES (?, ?, ?);");
                    $stmt->bind_param("sss", $fname , $lname, $mobile);

                    if($stmt->execute()){
                        $stmt = $conn->prepare("SELECT id, first_name, last_name, mobile_number FROM customer WHERE mobile_number=?;");
                        $stmt->bind_param("s", $mobile);
                        $stmt->execute();

                        $stmt->bind_result($id, $fname , $lname, $mobile);
                        $stmt->fetch();

                        $user = array(
                            'id'=>$id,
                            'fname'=>$fname,
                            'lname'=>$lname,
                            'mobile'=>$mobile,
                        );
                        $stmt->close();

                        $response['error'] = false;
                        $response['message'] = 'User registered successfully';
                        $response['user'] = $user;
                    }
                }
            }else{
                $response['error'] = true;
                $response['message'] = 'required parameters not found';
            }
        break;
        case 'login':
            if(isTheseParametersAvailable(array('mobile'))){
                $mobile = $_POST['mobile'];
            
                $stmt = $conn->prepare("SELECT id, first_name, last_name, mobile_number FROM customer WHERE mobile_number=?;");
                $stmt->bind_param("s", $mobile);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $stmt->bind_result($id, $fname , $lname, $mobile);
                    $stmt->fetch();

                    $user = array(
                        'id'=>$id,
                        'fname'=>$fname,
                        'lname'=>$lname,
                        'mobile'=>$mobile,
                    );
                    
                    $response['error'] = false;
                    $response['message'] = 'Login successfully';
                    $response['user'] = $user;
                }else{
                    $response['error'] = false;
                    $response['message'] = 'Invalid Number';
                }
            }
        break;
        default:
            $response['error'] = true;
            $response['message'] = 'Invalid Operation';
    }
}else{
    $response['error'] = true;
    $response['message'] = 'Invalid API call';
}

echo json_encode($response);

function isTheseParametersAvailable($params){
    foreach($params as $param){
        if(!isset($_POST[$param])){
            return false;
        }
    }
    return true;
}
