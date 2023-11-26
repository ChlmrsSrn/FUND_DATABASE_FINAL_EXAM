<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$conn = @mysqli_connect('localhost', $username, $password, 'inventory_database');

if($conn == true){
    $_SESSION['username'] = $username;
    header('Location: dashboard.php');
}else{
    include('index.php');
    echo "<h2><center>Connection Failed: Contact Administrator or Try Again</center></h2>";
}
?>