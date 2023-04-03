<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Add Doctor</title>
</head>
<body>
    <div class="header">
        <div class="inner_header">
            <a href="index.html">
            <div class="image_container">
                <img src="images/caduceus.png" width="112px">
            </div>
            <div class="headline_container"><h1>GO <span>HOSP</span></h1></div>
            </a>
            <ul class="navigators">
                <a href="index.html"><li>Home</li></a>
                <a href="misc.html"><li>Misc</li></a>
                <a href="about.html"><li>About</li></a>
                <a href="take_appointment_header.php"><li>Take Appointment</li></a>
                <a href="contact.html"><li>Contact</li></a>
            </ul>
        </div>
    </div>
    <div class="profile_container">
        <div class="profile_header">
            <ul class="profile_navigators">
                <a href="admin_doctor.php"><li>Add Doctor</li></a>
                <a href="admin_removeuser.php"><li>Remove User</li></a>
                <a href="myhospitals.php"><li>Hospital Datas</li></a>
                <a href="logout.php"><li>Logout</li></a>
            </ul>
        </div>
        <div class="form_container">
        <form method="POST" onsubmit="return confirm('Are you sure you want to add this doctor?');">
            <div class="infofield">
                <label for="country">Country</label>
                <input class="profinput" type="text" name="country" placeholder="Country" autocomplete="off" required> 
            </div>
            <div class="infofield">
                <label for="city">City</label>
                <input class="profinput" type="text" name="city" placeholder="City" autocomplete="off" required> 
            </div>
            <div class="infofield">
                <label for="district">District</label>
                <input class="profinput" type="text" name="district" placeholder="District" autocomplete="off" required> 
            </div>
            <div class="infofield">
                <label for="hospital">Hospital</label>
                <input class="profinput" type="text" name="hospital" placeholder="Hospital" autocomplete="off" required> 
            </div>
            <div class="infofield">
                <label for="speciality">Speciality</label>
                <input class="profinput" type="text" name="speciality" placeholder="Speciality" autocomplete="off" required> 
            </div>
            <div class="infofield">
                <label for="dname">Doctor Name-Surname</label>
                <input class="profinput" type="text" name="dname" placeholder="Doctor Name and Surname" autocomplete="off" required> 
            </div>
            <input class="submitapp" type="submit" name="submit" value="Add Doctor">
        </form>
        </div>
    </div>
</body>
</html>
<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gohospdb";
    $conn=new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_POST['submit'])) {
        if(isset($_POST['country']) && isset($_POST['city']) && isset($_POST['district']) && isset($_POST['hospital']) && isset($_POST['speciality']) && isset($_POST['dname'])) {
            $query="INSERT INTO hospitaldata (id, country, city, district, hospital, speciality, doctor) VALUES(NULL, \"".$_POST['country']."\",\"".$_POST['city']."\",\"".$_POST['district']."\",\"".$_POST['hospital']."\",\"".$_POST['speciality']."\",\"".$_POST['dname']."\")";
            $result = $conn->query($query);
            header('Location: myhospitals.php');
        }
    }
?>