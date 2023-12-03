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

        .btn{
            text-decoration: none;
            width: 100%;
            background-color: black;
            color: black;
            margin: 1% auto;
            padding: 2%;
            border-radius: 10px;
            text-align: center;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            border: .1em solid black;

            background: linear-gradient(to right, #70C1B3, #247B9F, white 60%);
            background-size: 200% 100%;
            background-position: right bottom;
            transition: all .3s ease-out;
        }

        .btn:hover {
            background-position: left bottom;
            color: white;
        }

        .add-card{
            width: 50%;
            margin-top: 5%;
            margin-left: 25%;
            border: 3px solid #212121;
            border-radius: 10px;
            padding: 2%;
        }

        .add-card p{
            font-weight: 700;
            margin-bottom: 2%;
            font-size: 2em;
        }

        .add-card hr{
            margin-bottom: 2%;
            border-top: 5px solid #212121;
            border-radius: 10px;
        }

        .add-card input{
            width: 100%;
            margin-top: 2%;
            margin-bottom: 2%;
            font-size: 1.5em;
            font-weight: 500;
            padding: 1%;
        }

        .add-card label{
            font-weight: 700;
        }


        h2{
            margin-left: 21%;
            margin-top: 5%;
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
        <h1>REMOVE INVENTORY</h1>
        <hr />

            <div class="add-card">

            <p><span style="color: red;">Delete</span> Inventory</p>
            <hr />
            <form id="myForm" action="remove.php" method="POST">
                <div class="grid-container">
                    <label>Product ID</label>
                    <input type="text" name="productID" />
                </div>

                <button class="btn" onclick="clicked()" value="Submit" name="submit">SUBMIT</button>
            </form>
        </div>
    </div>

        <?php
            if (isset($_POST['productID'])) {
            $productID = $_POST['productID'];
                $query = "DELETE FROM INVENTORY WHERE productID = $productID";
                if (mysqli_query($conn, $query)){
                        if (mysqli_affected_rows($conn) > 0) {
                            echo "<h2><center>INVENTORY DELETED SUCCESSFULLY</center></h2>";
                    } else {
                            echo "<h2><center>NO RECORD FOUND FOR DELETION</center></h2>";
                        }
                    } else {
                        echo "<h2><center>ERROR DELETING RECORD: CONTACT ADMINISTRATOR OR TRY AGAIN</center></h2>";
                    }
                }
        ?>

        <script>
            function clicked() {
            if (confirm('ARE YOU SURE?')) {
                yourformelement.submit();
            } else {
                return false;
            }
            }
        </script>
</body>
</html>