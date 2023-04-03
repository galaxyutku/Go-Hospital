<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Recover Password</title>
</head>
<?php 
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gohospdb";
        $conn=new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $query = "SELECT * FROM userdata WHERE id=\"".$_SESSION['tempid']."\"";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
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
    <div class="login_container">
        <div class="ltext">
            <p>Recovery check</p>
        </div>
    <form method="POST">
        <p style="padding-left: 15px; font-size:20px">
        <?php 
            if($row['secquestion'] == "petname") {
                echo "What is the name of your favorite pet?";
            }
            else if($row['secquestion'] == "cityborn") {
                echo "In what city were you born?";
            }
            else if($row['secquestion'] == "mothermaiden") {
                echo "What is your mother's maiden name?";
            }
            else if($row['secquestion'] == "highschool") {
                echo "What high school did you attend?";
            }
            else if($row['secquestion'] == "firstschool") {
                echo "What is the name of your first school?";
            }
            else if($row['secquestion'] == "carmake") {
                echo "What was the make of your first car?";
            }
            else if($row['secquestion'] == "favfood") {
                echo "What was your favorite food as a child?";
            }
            else if($row['secquestion'] == "metspouse") {
                echo "Where did you meet your spouse?";
            }
        ?>
        </p>
        <div class="field">
            <input type="text" placeholder="Security answer" name="secansw">
        </div>
        <span class="gosign"><p>Remember your password? <a href="login.php">Login</a></p></span>
        <div class="submitbutton">
            <input type="submit" value="Check" name="submit">
        </div>
    </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])) {
        if($row['secanswer'] == $_POST['secansw']) {
            header("Location: recover.php");
        }
        else{
            echo '<script type="text/JavaScript"> 
            alert("Wrong answer to security question!");
            </script>';
        }
    }
?>