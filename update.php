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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Raleway', sans-serif;
        }

        .sidepanel {
            height: 100%;
            width: 20%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #212121;
            overflow-x: hidden;
            padding-top: 7%;
            padding-left: 2%;
        }

        .sidepanel ul {
            list-style: none;
        }

        .sidepanel li {
            margin-top: 10%;
        }

        .sidepanel a {
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

        table th {
            background-color: #303030;
            padding: 1%;
            color: white;
            border-left: 2px solid white;
        }

        table td {
            padding: 1rem;
            border: 2px solid #212121;
        }

        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;
            margin-bottom: 8px;
        }


        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-edit{
            border: 2px solid black;
            padding: 2%;
            width: 70%;
            margin: 0 auto;
            border-radius: 20px;
            margin-top: 2%;
        }

        .form-control{
            font-weight: 500;
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
            font-size: 1.5em;
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

        <?php
        if (isset($_GET['productID'])) {
            $productID = $_GET['productID'];

            $query = "SELECT * FROM inventory WHERE productID = '$productID';";
            $result = @mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            } else {
                $row = @mysqli_fetch_assoc($result);

            }
        }
        ?>

        <?
        if (isset($_POST['updatebutton'])) {

            $productID = $_POST['productID'];
            $productName = $_POST['productName'];
            $brand = $_POST['brand'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];
            $status = $_POST['status'];

            $query = "UPDATE inventory set `ProductName`= '$productName', `brand`= '$brand', `description`= '$description', `category`='$category',
                `price`='$price',`stock_quantity`='$stock_quantity', `status`= '$status' WHERE `productID`=$productID";

            $result = @mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            } else {
                echo "
                    <script>
                        window.alert('Successfully Adjusted');
                        window.location.href = 'adjust.php';
                    </script>";

            }

        }
        ?>

        <h2>ADJUST STOCK</h2>
        <hr />

        <form class="form-edit" action="update.php" method="POST">
            <p></p>
            <div class="form-group">
                <label for="productID"><b>Product ID</b></label>
                <input type="text" name="productID" class="form-control" value="<?php echo $row['productID'] ?>"
                    readonly>
            </div>
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" name="productName" class="form-control" value="<?php echo $row['productName'] ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" class="form-control" value="<?php echo $row['brand'] ?>" required>
            </div>
            <div class="form-group">
                <label for="descriptioin">Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $row['description'] ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo $row['category'] ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $row['price'] ?>" required>
            </div>
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="text" name="stock_quantity" class="form-control"
                    value="<?php echo $row['stock_quantity'] ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control" value="<?php echo $row['status'] ?>" required>
            </div>
            <input type="submit" class="btn btn success" name="updatebutton" value="UPDATE"><br>

        </form>

</body>

</html>