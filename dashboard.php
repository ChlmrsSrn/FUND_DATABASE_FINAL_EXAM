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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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

        .grid-container{
            display: grid;
            grid-template-columns: 30% 30% 30%;
            column-gap: 3%;
            row-gap: 7%;
            margin-top: 3%;
        }

        .grid-item{
            border: 3px solid #303030;
            border-radius: 10px;
            height: 15em;
            padding: 3%;
        }
        
        .grid-item p{
            font-size: 1.2em;
            font-weight: 700;
            color: white;
        }

        .grid-item:nth-of-type(1){
            background-color: #4285F4;
        }

        .grid-item:nth-of-type(2){
            background-color: #34A853;   
        }
        
        .grid-item:nth-of-type(3){
            background-color: #FBB305;
        }

        .grid-item:nth-of-type(4){
            background-color: #EA4335;
            grid-column: span 3;
            grid-row: span 2;
        }

        .grid-item:nth-of-type(5){
            background-color:  #FBB305;
            grid-column: span 2;
        }

        .grid-item:nth-of-type(6){
            background-color: #4285F4;
        }

        .grid-item:nth-of-type(4) .material-symbols-outlined{
            font-size: 8em;
            position: relative;
            left: 75%;
        }

        .material-symbols-outlined{
            font-size: 8em;
            position: relative;
            left: 65%;
        }

        .material-symbols-outlined{
            opacity: 0.2;
        }

        .grid-item:nth-of-type(1) .data, .grid-item:nth-of-type(2) .data, .grid-item:nth-of-type(3) .data, .grid-item:nth-of-type(5) .data, .grid-item:nth-of-type(6) .data{
            margin-top: -22%;
            margin-left: 10%;
            font-size: 5.5em;
        }

        .grid-item:nth-of-type(4){
            padding: 2%;
        }

        .grid-item:nth-of-type(4) .data{
            margin-top: -11%;
        }

        table{
            color: white;
            font-weight: 500;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table th{
            width: 70%;
            padding: 1%;
        }
        
        table th:first-of-type{
            border-right: 2px solid white;
        }

        table td{
            text-align: center;
            padding: 1%;
            font-weight: 800;
            border-top: 2px solid white;
        }

        .grid-item:nth-of-type(5) .data, .grid-item:nth-of-type(6) .data{
            font-size: 1em;
        }
        
        .grid-item:nth-of-type(6) table{
            margin-top: -20%;
        }

        .grid-item:nth-of-type(5) table{
            margin-top: -15%;
            margin-left: 15%;
        }

        @media only screen and (max-width: 1440px) {
            .grid-item:nth-of-type(4) .data{
                margin-top: -13%;
            }

            .material-symbols-outlined{
                opacity: 0.1;
            }
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
        <h1>INVENTORY OVERVIEW</h1>
        <hr />

        <div class="grid-container">
            <div class="grid-item">
                <p>STOCK LEVEL</p>

                <div class="background-icon">
                    <span class="material-symbols-outlined">inventory</span>

                    <?php
                        $sql = "SELECT SUM(stock_quantity) AS total_stock FROM INVENTORY;";

                        $result = mysqli_query($conn, $sql);
                        
                        $row = mysqli_fetch_assoc($result);
                        $stockQuantity = $row['total_stock'];
                        
                        echo "<p class='data'>" .$stockQuantity . "</p>";
                    ?>
                    
                </div>
            </div>

            <div class="grid-item">
                <p>CURRENT PRODUCT COUNT</p>
                <div class="background-icon">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <?php
                        $sql = "SELECT COUNT(PRODUCTID) FROM INVENTORY;";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='data'>" . $row['COUNT(PRODUCTID)'] . "</p>";
                    ?>
                </div>
            </div>

            <div class="grid-item">
                <p>COMPLETED ORDERS</p>
                <div class="background-icon">
                    <span class="material-symbols-outlined">fact_check</span>
                    <?php
                        $sql = "SELECT COUNT(ORDERID) FROM ORDER_HISTORY;";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='data'>" . $row['COUNT(ORDERID)'] . "</p>";
                    ?>

                </div>
            </div>

            <div class="grid-item">
                <p>LOW ON STOCK</p>
                <div class="background-icon">
                    <span class="material-symbols-outlined">disabled_by_default</span>
                    <div class="data">
                        <?php
                            $lowStockCount = 10;
                            $sql = "SELECT productName, stock_quantity FROM INVENTORY WHERE stock_quantity < $lowStockCount;";
                            $result = mysqli_query($conn, $sql);

                            echo "<table>";
                            echo "<tr><th>PRODUCT NAME</th><th>STOCK COUNT</th></tr>";

                            while ($row = @mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['productName'] . "</td>";
                                echo "<td>" . $row['stock_quantity'] . "</td>";
                                echo "</tr>";
                            }

                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="grid-item">
                <p>HIGHEST STOCKED PRODUCT</p>
                <div class="background-icon">
                    <span class="material-symbols-outlined">fact_check</span>
                    <?php
                        $sql = "SELECT productName, stock_quantity FROM INVENTORY WHERE stock_quantity = (SELECT MAX(stock_quantity) FROM INVENTORY);";
                        $result = mysqli_query($conn, $sql);
                        echo "<table>";
                            echo "<tr><th>PRODUCT NAME</th><th>STOCK COUNT</th></tr>";

                            while ($row2 = @mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row2['productName'] . "</td>";
                                echo "<td>" . $row2['stock_quantity'] . "</td>";
                                echo "</tr>";
                            }

                        echo "</table>";
                    ?>
                </div>
            </div>


            <div class="grid-item">
                <p>LOWEST STOCKED PRODUCT</p>
                <div class="background-icon">
                    <span class="material-symbols-outlined">fact_check</span>
                    <?php
                        $sql = "SELECT productName, stock_quantity FROM INVENTORY WHERE stock_quantity = (SELECT MIN(stock_quantity) FROM INVENTORY);";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo "<table>";
                        echo "<tr><th>PRODUCT NAME</th><th>STOCK COUNT</th></tr>";

                        while ($row = @mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['productName'] . "</td>";
                            echo "<td>" . $row['stock_quantity'] . "</td>";
                            echo "</tr>";
                        }

                    echo "</table>";                    
                    ?>
                </div>
            </div>


        </div>
    </div>
    
</body>
</html>