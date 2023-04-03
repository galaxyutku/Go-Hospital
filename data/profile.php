<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Profile</title>
</head>
<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gohospdb";
    $conn=new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $query="SELECT * FROM userdata WHERE id=\"".$_SESSION['userid']."\"";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
    $row = $result->fetch_assoc();
    $_POST['profiledatarow'] = $row;
?>
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
        <div class="form_container">
        <form method="POST">
            <div class="infofield">
                <label for="email">Change E-mail</label>
                <?php echo "<input class=\"profinput\" type=\"text\" name=\"email\" placeholder=\"E-mail\" value=\"".($_POST['profiledatarow'])['email']."\">"; ?>
            </div>
            <div class="infofield">
                <label for="password">Change Password</label>
                <?php echo "<input class=\"profinput\" type=\"password\" name=\"password\" placeholder=\"Password\" value=\"".($_POST['profiledatarow'])['pw']."\">"; ?>
            </div>
            <div class="infofield">
                <label for="cpassword">Confirm Changed Password</label>
                <?php echo "<input class=\"profinput\" type=\"password\" name=\"pwconfirm\" placeholder=\"Confirm Password\" value=\"".($_POST['profiledatarow'])['pw']."\">"; ?>
            </div>
            <div class="infofield">
                <label for="nsname">Change Name-Surname</label>
                <?php echo "<input class=\"profinput\" type=\"text\" name=\"nsname\" placeholder=\"Name and Surname\" value=\"".($_POST['profiledatarow'])['nameandsurname']."\">"; ?>
            </div>
            <div class="infofield">
                <label for="age">Change Age</label>
                <?php echo "<input class=\"profinput\" type=\"number\" name=\"age\" placeholder=\"Age\" value=\"".($_POST['profiledatarow'])['age']."\">"; ?>
            </div>
            <div class="infofield">
                <label for="birthday">Change Birthday</label>
                <?php echo "<input class=\"profinput\" type=\"date\" name=\"birthday\" placeholder=\"Birthday\" value=\"".($_POST['profiledatarow'])['birthday']."\">"; ?>
            </div>
            <input class="submitapp" type="submit" name="submit" value="Change Informations">
        </form>
        </div>
    </div>
</body>
</html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gohospdb";
    $conn=new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    if (isset($_POST['submit'])) {
        if($_POST['password'] == $_POST['pwconfirm']) {
            $query="UPDATE userdata SET 
            nameandsurname =\"".$_POST['nsname']."\", 
            email =\"".$_POST['email']."\",
            age =\"".$_POST['age']."\",
            birthday =\"".$_POST['birthday']."\",
            pw =\"".$_POST['password']."\"
            WHERE id=\"".$_SESSION['userid']."\"";
            $result = $conn->query($query);
            if (!$result) die ("Database access failed: " . $conn->error);
            header("Refresh:0");
        }
        else {
            echo '<script type="text/JavaScript"> 
            alert("Passwords does not match!");
            </script>';
        }
    }
?>