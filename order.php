<?php
session_start();
 
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="x-icon/png" href="" />
    <title>Inventory</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Raleway', sans-serif;
        }

        .sidepanel{
            height: 100%;
            width: 20%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #212121;
            overflow-x: hidden;
            padding-top: 7% ;
            padding-left: 2%;
        }

        .sidepanel ul{
            list-style: none;
        }

        .sidepanel li{
            margin-top: 5%;
        }

        .sidepanel a{
            font-weight: 500;
            color: white;
            text-decoration: none;
            font-size: 1.2em;
        }

        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: black;
            text-decoration: none;
        }

        .hover-underline-animation:after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 3px;
            bottom: 0;
            left: 0;
            background-color: white;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }

        .hover-underline-animation:hover:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .main {
            margin-left: 20em;
            padding: 0 1%;
            width: 100%;
        }

    </style>

</head>
<body>
    <div class="sidepanel">
        <ul>
            <li><a class="hover-underline-animation" href="dashboard.php">DASHBOARD</li>
            <li><a class="hover-underline-animation" href="order.php">ORDER</li>
            <li><a class="hover-underline-animation" href="orderHistory.php">ORDER HISTORY</li>
            <li><a class="hover-underline-animation" href="current.php">CURRENT INVENTORY</li>
            <li><a class="hover-underline-animation" href="add.php">ADD INVENTORY</li>
            <li><a class="hover-underline-animation" href="remove.php">REMOVE INVENTORY</li>
            <li><a class="hover-underline-animation" href="adjust.php">ADJUST INVENTORY</li>
            <li><a class="hover-underline-animation" href="logout.php">LOG OUT</li>
        </ul>
    </div>

    <div class="main">
        <h1>ORDER</h1>
    </div>
    
</body>
</html>