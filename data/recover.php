<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Recovering Password</title>
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
    <div class="login_container">
        <div class="ltext">
            <p>Recover</p>
        </div>
    <form method="POST">
        <div class="field">
            <input type="password" placeholder="New password" name="newpw" autocomplete="off" required>
        </div>
        <div class="field">
            <input type="password" placeholder="Confirm new password" name="newpwconfirm" autocomplete="off" required>
        </div>
        <div class="submitbutton">
            <input type="submit" value="Recover" name="submit">
        </div>
    </form>
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
            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
            if(isset($_POST['submit'])) {
                if($_POST['newpw'] == $_POST['newpwconfirm']) {
                $query = "UPDATE userdata SET pw=\"".$_POST['newpw']."\" WHERE id=\"".$_SESSION['tempid']."\"";
                $result = $conn->query($query);
                if (!$result) die ("Database access failed: " . $conn->error);
                header("Location: login.php");
                }
                else{
                    echo '<script type="text/JavaScript"> 
                    alert("Passwords does not match!");
                    </script>';
                }
            }
?>