<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download App</title>
    <style>
        body{
            background-color: lightgreen;
            height: 100vh;
            width: 100vw;
            display: grid;
            justify-content: center;
            align-items: center;
        }

        .view{
            display: grid;
            justify-content: center;
            align-items: center;
            color: #000;
        }

        img {
            width: 100%;
        }
        a{
            text-decoration: none;
            color: #fff;
        }
        
        button {
            font-weight: bold;
            color: #fff !important;
            text-transform: uppercase;
            text-decoration: none;
            background: crimson ;
            padding: 20px 30px;
            border-radius: 5px;
            display: inline-block;
            border: none;
            transition: all 0.4s ease 0s;
            cursor: pointer;
        }

        button:hover{
            background: #434343;
            letter-spacing: 1px;
            -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
            transition: all 0.4s ease 0s;
        }
    </style>
</head>
<body>
<div class="view">
    <img src="/Giligans/images/logo.svg"/>
    <h1>Download Giligans App</h1>
    <button><a href="/app-debug.apk">Download</a></button>
</div>
</body>
</html>