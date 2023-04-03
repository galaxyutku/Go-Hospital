<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Signup</title>
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
                <a href="login.php"><li>Take Appointment</li></a>
                <a href="contact.html"><li>Contact</li></a>
            </ul>
        </div>
    </div>
    <div class="login_container">
        <div class="ltext">
            <p>Signup</p>
        </div>
        <form action="signup.php" method = "POST">
        <div class="field">
            <label for="email">E-mail</label>
            <input type="text" placeholder="E-mail" autocomplete="off" name="email" required>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" autocomplete="off" name="password" required>
        </div>
        <div class="field">
            <label for="pwconfirm">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" autocomplete="off" name="pwconfirm" required>
        </div>
        <div class="field">
            <label for="nsname">Name and Surname</label>
            <input type="text" placeholder="Name and surname" autocomplete="off" name="nsname" required>
        </div>
        <div class="field">
            <label for="age">Age</label>
            <input type="number" placeholder="Age" autocomplete="off" name="age" required>
        </div>
        <div class="field">
            <label for="birthday">Birthday date</label>
            <input type="date" name="birthday" autocomplete="off" required>
        </div>
        <div class="field">
            <label for="secquestion">Choose a security question</label>
            <select name="secquestion" autocomplete="off" required>
                <option disabled selected>Select your security question</option>
                <option value="petname">What is the name of your favorite pet?</option>
                <option value="cityborn">In what city were you born?</option>
                <option value="mothermaiden">What is your mother's maiden name?</option>
                <option value="highschool">What high school did you attend?</option>
                <option value="firstschool">What is the name of your first school?</option>
                <option value="carmake">What was the make of your first car?</option>
                <option value="favfood">What was your favorite food as a child?</option>
                <option value="metspouse">Where did you meet your spouse?</option>
            </select>
        </div>
        <div class="field">
            <label for="secanswer">Answer of your security quesiton</label>
            <input type="text" placeholder="Security answer" autocomplete="off" name="secanswer" required>
        </div>
        <div class="submitbutton">
            <input type="submit" value="Signup" name="submit">
        </div>
        <span class="gosign"><p>Already have an account? <a href="login.php">Login</a></p></span>
    </form>
    </div>
</body>
</html>
<?php
session_start();
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pwconfirm'])
    && !empty($_POST['nsname']) && !empty($_POST['age']) && !empty($_POST['birthday'])
    && !empty($_POST['secquestion']) && !empty($_POST['secanswer'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gohospdb";
        $conn=new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pwconfirm = $_POST['pwconfirm'];
        $nsname = $_POST['nsname'];
        $age = $_POST['age'];
        $birthday = date('Y-m-d', strtotime($_POST['birthday']));
        $secquestion = $_POST['secquestion'];
        $secanswer = $_POST['secanswer'];
        $query = "SELECT * FROM userdata";
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
        $bool = true;
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()) {
                if($rows['email'] == $_POST['email'])
                {
                    $bool = false;
                    echo '<script type="text/JavaScript"> 
                    alert("This Email has already been taken!");
                    </script>';
                }
            }
        }
            if(($password == $pwconfirm) && ($bool == true)){
                $query = "INSERT INTO userdata VALUES(NULL, '$nsname', '$password', '$age', '$email', '$birthday', '$secquestion', '$secanswer')";
                $result = $conn->query($query);
                if (!$result) die ("Database access failed: " . $conn->error);
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['nsname'] = $nsname;
                $_SESSION['age'] = $age;
                $_SESSION['birthday'] = $birthday;
                $_SESSION['secquestion'] = $secquestion;
                $_SESSION['secanswer'] = $secanswer;
                header("Location: take_appointment.php");
            }
            else{
                echo '<script type="text/JavaScript"> 
                alert("Passwords does not match!");
                </script>';
            }
        }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gohospdb";
    $conn=new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
        $query="SELECT id FROM userdata WHERE email=\"".$_POST['email']."\" AND pw=\"".$_POST['password']."\"";
        $result = $conn->query($query);
        $rows= $result->fetch_assoc();
        $_SESSION['userid'] = $rows['id'];
    }
?>