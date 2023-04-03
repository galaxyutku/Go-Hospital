<?php
date_default_timezone_set('UTC');
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gohospdb";
$conn=new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['country_id'])) {
    $_SESSION['country_id'] = $_POST['country_id'];
    $query= "SELECT DISTINCT city FROM hospitaldata WHERE country=\"".$_POST['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select City</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
        }
    }
    else{
        echo '<option>None of the cities are available</option>';
    }
}
else if(isset($_POST['city_id'])) {
    $_SESSION['city_id'] = $_POST['city_id'];
    $query= "SELECT DISTINCT district FROM hospitaldata WHERE city=\"".$_POST['city_id']."\" AND country=\"".$_SESSION['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select Disctrict</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['district'].'">'.$row['district'].'</option>';
        }
    }
    else{
        echo '<option>None of the disctricts are available</option>';
    }
}
else if(isset($_POST['district_id'])) {
    $_SESSION['district_id'] = $_POST['district_id'];
    $query= "SELECT DISTINCT hospital FROM hospitaldata WHERE district=\"".$_POST['district_id']."\" AND city=\"".$_SESSION['city_id']."\" AND country=\"".$_SESSION['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select Hospital</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['hospital'].'">'.$row['hospital'].'</option>';
        }
    }
    else{
        echo '<option>None of the hospitals are available</option>';
    }
}
else if(isset($_POST['hospital_id'])) {
    $_SESSION['hospital_id'] = $_POST['hospital_id'];
    $query= "SELECT DISTINCT speciality FROM hospitaldata WHERE hospital=\"".$_POST['hospital_id']."\" AND district=\"".$_SESSION['district_id']."\" AND city=\"".$_SESSION['city_id']."\" AND country=\"".$_SESSION['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select Speciality</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['speciality'].'">'.$row['speciality'].'</option>';
        }
    }
    else{
        echo '<option>None of the specialities are available</option>';
    }
}
else if(isset($_POST['speciality_id'])) {
    $_SESSION['speciality_id'] = $_POST['speciality_id'];
    $query= "SELECT DISTINCT doctor FROM hospitaldata WHERE speciality=\"".$_POST['speciality_id']."\" AND hospital=\"".$_SESSION['hospital_id']."\" AND district=\"".$_SESSION['district_id']."\" AND city=\"".$_SESSION['city_id']."\" AND country=\"".$_SESSION['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select Doctor</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['doctor'].'">'.$row['doctor'].'</option>';
        }
    }
    else{
        echo '<option>None of the doctors are available</option>';
    }
}
else if(isset($_POST['doctor_id'])) {
    $_SESSION['doctor_id'] = $_POST['doctor_id'];
    $query= "SELECT id FROM hospitaldata WHERE doctor=\"".$_POST['doctor_id']."\" AND speciality=\"".$_SESSION['speciality_id']."\" AND hospital=\"".$_SESSION['hospital_id']."\" AND district=\"".$_SESSION['district_id']."\" AND city=\"".$_SESSION['city_id']."\" AND country=\"".$_SESSION['country_id']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows=$result->fetch_assoc();
    $_SESSION['temphospid'] = $rows['id'];
    $startdate=strtotime("now");
    $enddate=strtotime("+15 day", $startdate);
    echo '<option value"" selected disabled>Select Date</option>';
    while($startdate < $enddate) {
        echo '<option value='.date("Y-m-d",$startdate).'>'.date("Y-m-d",$startdate).'</option>';
        $startdate = strtotime("+1 day", $startdate);
    }
}
else if(isset($_POST['date_id'])) {
    $_SESSION['date_id'] = $_POST['date_id'];
    $query= "SELECT * FROM appointmentdata WHERE appdate=\"".$_POST['date_id']."\" AND hospid=\"".$_SESSION['temphospid']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $rows=$result -> fetch_assoc();
    $startdate=strtotime("09:00");
    $enddate=strtotime("8 hours", $startdate);
    echo '<option value"" selected disabled>Select Time</option>';
    while($startdate < $enddate) {
            if($rows['apptime'] != (date("H:i:00", $startdate))){
                echo '<option value='.date("H:i:00",$startdate).'>'.date("H:i:00",$startdate).'</option>';
            }
            else{
                $rows=$result->fetch_assoc();
            }
        $startdate = strtotime("+20 minute", $startdate);
    }
}
if(isset($_POST['time_id'])){
    $_SESSION['time_id'] = $_POST['time_id'];
}
?>