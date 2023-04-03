<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Login</title>
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
            <p>Login</p>
        </div>
    <form method="POST">
        <div class="field">
            <input type="text" autocomplete="off" placeholder="E-mail" name="email" required>
        </div>
        <div class="field">
            <input type="password" autocomplete="off" placeholder="Password" name="password" required>
        </div>
        <div class="forgpw">
            <p><a href="forgotpw.php">Forgot Password?</a></p>
        </div>
        <div class="submitbutton">
            <input type="submit" id="submit" value="Login" name="submit">
        </div>
        <span class="gosign"><p>Don't have an account <a href="signup.php">Signup</a></p></span>
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
    $query="SELECT * FROM userdata";
    $result = $conn->query($query);
    if(isset($_POST['submit'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            if($_POST['email'] == 'admin' && $_POST['password'] == 'root') {
                header("Location: adminpanel.php");
                $_SESSION['userid'] = 'admin';
            }
            if($result->num_rows > 0) {
                while($rows = $result -> fetch_assoc()) {
                    if(($rows['email'] == $_POST['email']) && ($rows['pw'] == $_POST['password'])) {
                        $_SESSION['userid'] = $rows['id'];
                        header("Location: take_appointment.php");
                    }
                }
                echo '<script type="text/JavaScript"> 
                alert("Invalid Email or Password");
                </script>';
            }
        }
    }
?>