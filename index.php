<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /Management/queuing.php");
    exit;
}
session_destroy();
// Include config file
require "./php/init.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }   
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, level FROM users WHERE username = ? && password = ?";
           
        if($stmt = $conn->prepare($sql)){           
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);           
            // Set parameters
            $param_username = $username;
            $param_password = $password;          
            // Attempt to execute the prepared statement
            if($stmt->execute()){             
                // Store result
                $stmt->store_result();             
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){      
                    // Bind result variables
                    $stmt->bind_result($id, $username, $password, $level);
                    if($stmt->fetch()){
                            // Password is correct, so start a new session
                            session_start();                         
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                                               
                            $_SESSION["level"] = $level;                                               
                            // Redirect user to welcome page
                            header("location: /Management/queuing.php");
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $conn->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="192x192"  href="./src/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./src/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./src/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./src/favicon-16x16.png">
    <link rel="manifest" href="./src/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./src/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Admin Login</title>
     <link rel="stylesheet" href="./Management/styles/bootstrap.min.css">
    <style>
        body{ 
            height: 100vh;
            font: 14px sans-serif; 
            display: grid;
            place-items: center;
            width: 100%;
            min-width: 1200px;
        }
        .wrapper{ 
            width: 30%;
            padding: 20px; 
            background-color: #fff;
            box-shadow: 7px 10px 46px -5px rgba(0,0,0,0.16);
            -webkit-box-shadow: 7px 10px 46px -5px rgba(0,0,0,0.16);
            -moz-box-shadow: 7px 10px 46px -5px rgba(0,0,0,0.16);
            padding-top: 10px;
        }

        .logo{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        img {
            width: 14rem;
            aspect-ratio: 1;
            object-fit: cover;
        }

        .title{
            text-align: center;
            padding: 0;
            
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="/API/images/logo.png"/>
        </div>
        <h2 class="title">Kumpares Management Admin Login</h2>
        <p>Please fill in admin credentials to login.</p>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>
</body>
</html>