<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gohospdb";
$conn=new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "conntected successfully <br>";
$query = "INSERT INTO appointmentdata VALUES(NULL, 1, 2, '2021-12-25', '15:00:00')";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
?>