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
$query = "CREATE TABLE userdata (id SMALLINT NOT NULL AUTO_INCREMENT,
 nameandsurname VARCHAR(128) NOT NULL,
 pw VARCHAR(128) NOT NULL,
 age TINYINT NOT NULL, 
 email VARCHAR(128) NOT NULL, 
 birthday DATE NOT NULL, 
 secquestion VARCHAR(150) NOT NULL, 
 secanswer VARCHAR(128) NOT NULL, PRIMARY KEY (id))";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
?>