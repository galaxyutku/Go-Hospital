<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>My appointments</title>
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
                <a href="profile.php"><li>Profile</li></a>
                <a href="take_appointment.php"><li>Take Appointment</li></a>
                <a href="myappointments.php"><li>My Appointments</li></a>
                <a href="logout.php"><li>Logout</li></a>
            </ul>
        </div>
        <div class="app_table">
            <h1>Your Appointments</h1>
            <?php
                session_start();
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gohospdb";
                $conn=new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
                $query="SELECT * FROM appointmentdata WHERE patientid=\"".$_SESSION['userid']."\"";
                $result = $conn->query($query);
                if (!$result) die ("Database access failed: " . $conn->error);
                if($result->num_rows > 0) {
                    echo 
                    "<table>
                    <thead>
                    <tr> 
                    <th>ID</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Hospital</th>
                    <th>Speciality</th>
                    <th>Doctor</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = $result->fetch_assoc()) {
                        $query2="SELECT * FROM hospitaldata WHERE id=\"".$row['hospid']."\"";
                        $result2 = $conn->query($query2);
                        if (!$result2) die ("Database access failed: " . $conn->error);
                        $row2 = $result2->fetch_assoc();
                        echo
                        "<tr>
                        <th>".$row['id']."</th>
                        <th>".$row2['country']."</th>
                        <th>".$row2['city']."</th>
                        <th>".$row2['district']."</th>
                        <th>".$row2['hospital']."</th>
                        <th>".$row2['speciality']."</th>
                        <th>".$row2['doctor']."</th>
                        <th>".$row['appdate']."</th>
                        <th>".$row['apptime']."</th>
                        </tr>";
                }
                echo "</tbody></table>";
            }
            else{
                echo "<h2>You don't have any appointment right now.</h2>";
            }
            ?>
        </div>
        <form method="POST" onsubmit="return confirm('Are you sure you want to remove this appointment?');">
        <div class="idremove">
            <input class="putbox" type="number" autocomplete="off" placeholder="Appointment ID" name="removeid" required>
            <input class="submitapp" type="submit" value="Remove Appointment" name="submitbutton">
        </div>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submitbutton'])) {
        $query="DELETE FROM appointmentdata WHERE id=\"".$_POST['removeid']."\"";
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
        header("Location: myappointments.php");
    }
?>