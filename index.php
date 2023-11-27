<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="x-icon/png" href="favicon_database.png" />
    <title>Inventory</title>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700&display=swap');


*{
box-sizing: border-box;
margin: 0;
padding: 0;
font-family: 'Raleway', sans-serif;
}

body{
background-color: #0D1312ff;
}

.split {
  height: 100%;
  width: 50%;
  position: fixed;
  top: 0;
  overflow: hidden;
}

.left{
    left: 0;
    margin: 8%;
    width: 30%;
    height: 100%;
    padding: 1%;
}

.right{
    right: 0;
}

.right img{
    width: 100%;
}

h3{
    font-size: 3em;
    letter-spacing: -.1em;
    line-height: 1.5em;
    text-align: center;
    color: white;
    margin-bottom: 1em;
}

.input-box{
    margin: .5em;;
}

label{
    color: white;
    font-size: 1.5em;
    font-weight: 700;
    letter-spacing: -.1em;
}

input{
    width: 100%;
    font-size: 1.5em;
    border-radius: 10px;
    margin-top: .5em;
    padding: .5em;
    margin-bottom: 1.5em;
}

a{
    display: block;
}

.btn, a{
    text-decoration: none;
    width: 100%;
    background-color: black;
    color: black;
    margin: 2% auto;
    padding: 2%;
    border-radius: 50px;
    text-align: center;
    font-size: 1.5em;
    font-weight: 700;
    cursor: pointer;
    border: .1em solid black;

    background: linear-gradient(to right, #556B77ff, #8398A3ff, white 50%);
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
    <div class="split left">
        <h3>INVENTORY DATABASE</h3>
        <form action="authentication.php" method="POST">
            <label>USERNAME</label>
            <input type="text" name="username"/>
            <label>PASSWORD</label>
            <input type="password" name="password" />

            <button class="btn">LOG IN</button>
        </form>
    </div>
    <div class="split right">
        <img src="loginImage(1).jpg" />
    </div>
</body>
</html>