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
$query = "INSERT INTO hospitaldata VALUES(NULL, 'Turkey', 'Ankara', 'Yenimahalle', 'Devlet Hastanesi', 'Göz Hastalıkları', 'Utku Akbaba'), (NULL, 'Turkey', 'İstanbul', 'Yenimahalle', 'Yıldırım Beyazıt', 'Kalp', 'Hiko baba')";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
?>