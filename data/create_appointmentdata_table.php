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
$query = "CREATE TABLE appointmentdata 
(id SMALLINT NOT NULL AUTO_INCREMENT,
 patientid SMALLINT NOT NULL,
 hospid SMALLINT NOT NULL,
 appdate DATE,
 apptime TIME,
 PRIMARY KEY (id))";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
?>