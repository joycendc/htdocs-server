<?php
    require "./php/init.php";

    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../index.php");
        exit;
    }
  
    if(array_key_exists('button1', $_POST)) { 
        button1(); 
    } else if(array_key_exists('button2', $_POST)) { 
        button2(); 
    }  else if(array_key_exists('button3', $_POST)) { 
        button3(); 
    } else if(array_key_exists('button4', $_POST)) { 
        button4(); 
    } 
    function button1() { 
        header("location: /Management/queuing.php");
    } 
    function button2() { 
        header("location: /Management/management.php");
    } 
     function button4() { 
        header("location: /Management/transactions.php");
    } 
    function button3() { 
        // Initialize the session
        session_start();
        // Unset all of the session variables
        $_SESSION = array();
        // Destroy the session.
        session_destroy();
        // Redirect to login page
        header("location: ../");
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Welcome to Dashboard</title>
        <style>
        body{
            height: 100vh;
            display: grid;
            place-items: center;
        }  

        .container {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            width: 400px;
            height: 200px;
            font-size: 15px;
            font-weight: bold;
            color: #fff !important;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            transition: all 0.4s ease 0s;
            cursor: pointer;
            margin: 10px;
            border-radius: 10px;   
            -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
        }

        .card:hover{
            border-radius: 10px;   
            background: #43433;
            letter-spacing: 1px;
            -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.80);
            -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.80);
            box-shadow: 5px 40px -10px rgba(0,0,0,0.80);
            transform: scale(1.1);
            transition: all 0.3s ease 0s;
        }

        .buttonn {
            border: none;    
            border-radius: 10px;  
            font-weight: bold; 
            font-size: 25px;
        }

        .queue{
            height: 100%;
            width: 100%;
            padding: 20px 30px;
            background-color: green;
            color: #fff;
        }
        .manage{
            height: 100%;
            width: 100%;
            padding: 20px 30px;
            background-color: blue;
            color: #fff;
        }
        .logout{
            height: 100%;
            width: 100%;
            padding: 20px 30px;
            
            color: #fff;
            background: red;
        }
        .recent {
            height: 100%;
            width: 100%;
            padding: 20px 30px;
        
            color: #fff;
            background: orange;
        }
        </style>
    </head>
    <body>
        <form method="POST"> 
            <div class="container">
                <div class="card">
                    <input type="submit" name="button1" class="buttonn queue" value="Queuing" /> 
                </div>
                <div class="card">
                    <input type="submit" name="button2" class="buttonn manage" value="Product Management" />   
                </div>   <div class="card">
                    <input type="submit" name="button4" class="buttonn recent" value="Recent Orders" />              
                </div>
                <div class="card">
                    <input type="submit" name="button3" class="buttonn logout" value="Logout" />         
                </div>
            </div>
        </form> 
        <script src="./js/jquery.js"></script>
    </body>
</html>