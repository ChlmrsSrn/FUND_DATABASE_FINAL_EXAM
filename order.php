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

        .order-card{
            margin-top: 3%;
            margin-left: 30%;
        }

        .order-card p{
            font-weight: 700;
            font-size: 2em;
            margin-bottom: 2%;
        }

        .order-card hr{
            margin-bottom: 2%;
            border-top: 5px solid #212121;
            border-radius: 10px;
        }

        form{
            padding: 2%;
            width: 60%;
            height: 50%;
            display: inline-block;
            border: 2px solid #212121;
        }

        label {
            font-weight: 700;
            display: block;
        }

        input, textarea, select{
            width: 100%;
            margin-top: 2%;
            margin-bottom: 2%;
            font-size: 1.5em;
            font-weight: 500;
            padding: 2%;
        }

        table #products_table{
            border-collapse: collapse;
            margin: 0 auto;
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

        #selection {
            border-collapse: collapse;
            margin: 0 auto;
            width: 80%;
            margin-top: 2%;
            margin-bottom: 2%;
        }

        #selection th{
            background-color: #303030;
            padding: 1%;
            color: white;
            border-left: 2px solid white;
        }

        #selection td {
            padding: 1rem;
            border: 2px solid #212121;
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
        <h1>ORDER</h1>
        <hr />
        
        <div class="order-card">

            <form action="order.php" method="POST">
                <p class="section">Order Slip</p>
                <hr />

                <label>Date Today</label>
                <input type="date" name="currentDate" value="<?php echo date('Y-m-d'); ?>" />

                <label>Customer Name / Requestor</label>
                <input type="text" name="customerName" required />

                <table id="productsTable">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="productName[]"></td>
                        <td><input type="number" name="productQuantity[]"></td>
                        <td><button class="btn" type="button" onclick="removeRow(this)">Remove</button></td>
                    </tr>
                </table>

                <button type="button" class="btn" onclick="addRow()">Add Product</button>


                <label>Mode of Payment</label>
                <select name="mop">
                    <option value="Card">Card</option>
                    <option value="Cash On Delivery">Cash on Delivery</option>
                </select>

                <p class="section">Shipping Information</p>

                <label>Receiver's Name</label>
                <input type="text" name="order-reciever" />

                <label>Address</label>
                <input type="text" name="shipping-address" />

                <label>ZIP Code</label>
                <input type="number" name="zip" />

                <label>Contact Number</label>
                <input type="number" name="contact-number" />
                
                <label>Remarks</label>
                <textarea name="remarks"></textarea>

                <button class="btn" value="Submit" name="submit">SUBMIT</button>

            </form>
        </div>

        <div class="curr-table">

            <?php
                $query = 'SELECT * FROM INVENTORY WHERE STATUS = "Active";';
                $result = mysqli_query($conn, $query);
    
                echo "<table id='selection'>";
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

    </div>

    <?php
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentDate = $_POST["currentDate"];
        $customerName = $_POST["customerName"];
        $paymentMethod = $_POST["mop"];
        $receiverName = $_POST["order-reciever"];
        $shippingAddress = $_POST["shipping-address"];
        $zipCode = $_POST["zip"];
        $contactNumber = $_POST["contact-number"];
        $remarks = $_POST["remarks"];
    
        $concatenatedProducts = "";
        $totalQuantity = 0;
    
        if (isset($_POST["productName"]) && isset($_POST["productQuantity"])) {
            $productNames = $_POST["productName"];
            $quantities = $_POST["productQuantity"];
    
            for ($i = 0; $i < count($productNames); $i++) {
                $productName = mysqli_real_escape_string($conn, $productNames[$i]);
                $quantity = intval($quantities[$i]);
                $concatenatedProducts .= $productName . ', ';
                $totalQuantity += $quantity;
            }
    
            $concatenatedProducts = rtrim($concatenatedProducts, ', ');

            $insertQuery = "INSERT INTO order_history (orderDate, customerName, productName, quantity, paymentMethod, receiverName, shippingAddress, zipCode, contactNumber, remarks) 
                VALUES ('$currentDate', '$customerName', '$concatenatedProducts', '$totalQuantity', '$paymentMethod', '$receiverName', '$shippingAddress', '$zipCode', '$contactNumber', '$remarks')";
    
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>alert('Order data inserted successfully.')</script>";
            } else {
                echo "<script>alert('Order Failed Contact Administrator.')</script>" . mysqli_error($conn);
            }
        }
    }

    ?>

<script>
        function addRow() {
            var table = document.getElementById("productsTable");
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML = '<input type="text" name="productName[]">';
            cell2.innerHTML = '<input type="number" name="productQuantity[]">';
            cell3.innerHTML = '<button type="button" class="btn" onclick="removeRow(this)">Remove</button>';
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
    
</body>
</html>