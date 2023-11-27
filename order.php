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
            margin-top: 2%;
            margin-left: 20%;
            padding: 0 1%;
            width: 80%;
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
        }

        table{
            border-collapse: collapse;
            margin: 0 auto;
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

        <div class="order-card">

            <form action="order.php" method="POST">
                <p class="section">Order Slip</p>
                <label>Date Today</label>
                <input type="date" name="currentDate" />

                <label>Customer Name / Requestor</label>
                <input type="text" name="customerName" required />

                <table id="productsTable">
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total Cost</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="productID"></td>
                        <td><input type="text" name="productName"></td>
                        <td><input type="int" name="productQuantity"></td>
                        <td><input type="text" name="productName"></td>
                        <td><input type="text" name="productName"></td>
                    </tr>
                </table>

                <button type="button" class="add-item-button" onclick="addRow()">Add Product</button>

                <label>Mode of Payment</label>
                <select name="mop">
                    <option>Card</option>
                    <option>Cash on Delivery</option>
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

            </form>

        </div>
    </div>

    <script>
        function addRow() {
            var table = document.getElementById("productsTable");
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = '<input type="text" name="productName[]">';
            cell2.innerHTML = '<input type="text" name="productName[]">';
            cell3.innerHTML = '<input type="number" name="productQuantity[]">';
            cell4.innerHTML = '<input type="text" name="unitCost[]">';
            cell5.innerHTML = '<input type="text" name="totalCost[]">';
            cell6.innerHTML = '<button type="button" onclick="removeRow(this)">Remove</button>';
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
    
</body>
</html>