<?php
// four variables or parameter are use for connection

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed :" . $conn->connect_error);
}
//  else {
//     echo "Numan";
// }

// $con = mysqli_connect($servername, $username, $password, $dbname);
// if (mysqli_connect_errno()) {
//     echo "Failed to connect to MySQL: " . mysqli_connect_error();
//     die();
// }
