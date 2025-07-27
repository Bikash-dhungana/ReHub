<?php
//database connection
$servername = "localhost";
$username="root";
$password= "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);

//check conection
if(!$conn){
    die("Connection failed".mysqli_connect_error());
}
?>