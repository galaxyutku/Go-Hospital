<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION['userid'])) {
        if($_SESSION['userid'] == 'admin') {
            header("Location: adminpanel.php");
        }
        else{
            header("Location: take_appointment.php");
        }
    }
    else {
        header("Location: login.php");
    }
?>