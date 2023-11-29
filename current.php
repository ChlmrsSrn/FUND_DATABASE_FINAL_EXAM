<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$conn = @mysqli_connect('localhost', 'admin', 'admin', 'inventory_database');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />    
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
            margin-top: 10%;
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
            margin-top: 2%;
            margin-left: 20%;
            padding: 0 1%;
            width: 80%;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
            margin-top: 2%;
        }

        table th{
            background-color: #303030;
            padding: 1%;
            color: white;
            border-left: 2px solid white;
        }

        table td {
            padding: 1rem;
            border: 2px solid #212121;
        }

        .search {
            width: 50%;
            border: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin: 2% auto;
        }

        .search form{
            width: 100%;
            display: flex;
            align-items: center;
        }

        .search input{
            flex: 1;
            border: 0;
            outline: none;
            padding: 10px 10px;
            background: white;
            margin-left: 15px;
            font-size: 1.5em;
        }

        .search button{
            width: 25px;
            border: 0;
            background: white;
            margin-right: 15px;
        }

        .search button:hover{
            background-color: grey;
            border-radius: 50px;
        }
    </style>

</head>
<body>
    <div class="sidepanel">
        <ul>
            <li><a class="hover-underline-animation" href="dashboard.php">DASHBOARD</a></li>
            <li><a class="hover-underline-animation" href="order.php">ORDER</a></li>
            <li><a class="hover-underline-animation" href="orderHistory.php">ORDER HISTORY</a></li>
            <li><a class="hover-underline-animation" href="current.php">CURRENT INVENTORY</a></li>
            <li><a class="hover-underline-animation" href="add.php">ADD INVENTORY</a></li>
            <li><a class="hover-underline-animation" href="remove.php">REMOVE INVENTORY</a></li>
            <li><a class="hover-underline-animation" href="adjust.php">ADJUST INVENTORY</a></li>
            <li><a class="hover-underline-animation" href="logout.php">LOG OUT</a></li>
        </ul>
    </div>

    <div class="main">
        <h1>CURRENT INVENTORY</h1>
        <hr />

        <div class="search">
            <form action="current.php" method="POST">
                <input type="text" name="search-query" />
                <button type="submit" value="Submit"><span class="material-symbols-outlined">Search</span></button>
            </form>
        </div>

        <?php
            if (isset($_POST['search-query'])) {
                $searchQuery = mysqli_real_escape_string($conn, $_POST['search-query']);
                $query = "SELECT * FROM INVENTORY WHERE productName LIKE '%$searchQuery%' OR brand LIKE '%$searchQuery%' OR category LIKE '%$searchQuery%';";
            } else {
                $query = 'SELECT * FROM INVENTORY;';
            }

            $result = mysqli_query($conn, $query);

            echo "<table>";
            echo "<tr>";
            echo "<th>PRODUCT ID</th>";
            echo "<th>PRODUCT NAME</th>";
            echo "<th>BRAND</th>";
            echo "<th>DESCRIPTION</th>";
            echo "<th>CATEGORY</th>";
            echo "<th>PRICE</th>";
            echo "<th>STOCK QUANTITY</th>";
            echo "<th>STATUS</th>";
            echo "</tr>";

            while ($row = @mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['productID'] . "</td>";
                echo "<td>" . $row['productName'] . "</td>";
                echo "<td>" . $row['brand'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['stock_quantity'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </div>
    
</body>
</html>