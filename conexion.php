<?php
$rutaabsoluta = 'http://localhost:81/vyvytion/';


$servername = "localhost";
$database   = "proyecto_sublink";
$username   = "root";
$password   = "rootroot";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>