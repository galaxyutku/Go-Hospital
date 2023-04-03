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
$query = "CREATE TABLE hospitaldata 
(id SMALLINT NOT NULL AUTO_INCREMENT,
 country VARCHAR(128) NOT NULL,
 city VARCHAR(128) NOT NULL,
 district VARCHAR(128) NOT NULL, 
 hospital VARCHAR(128) NOT NULL, 
 speciality VARCHAR(128) NOT NULL, 
 doctor VARCHAR(150) NOT NULL, 
 appdate DATE NOT NULL, 
 PRIMARY KEY (id))";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
?>