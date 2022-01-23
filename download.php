<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download App</title>
    <style>
        body{
            background-color: #fff;
            height: 90vh;
            width: 90vw;
            display: grid;
            justify-content: center;
            align-items: center;
        }
        .view{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #cf242a;
        }

        img {
            width: 300px;
        }
        a{
            text-decoration: none;
            color: #fff;
            padding: 20px 140px;
            
        }

        h1{
            font-size: 25px;
        }
        button {
            font-weight: bold;
            color: #fff !important;
            text-transform: uppercase;
            text-decoration: none;
            background: #cf242a;
            padding: 20px 0px;
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
    <img src="/API/images/logo.png"/>
    <h1>Download Kumpares Food Order and Queue App</h1>
    <button><a href="/app-debugs.apk">Download</a></button>
</div>
</body>
</html>