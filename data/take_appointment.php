<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Take Appointment</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                $query= "SELECT DISTINCT country FROM hospitaldata";
                $result = $conn->query($query);
            ?>
        <div class="form_container">
        <form method="POST" onsubmit="return confirm('Are you sure you want to comfirm that appointment?');">
            <div class="infofield">
                <label for="country">Country</label>
                <select name="country" id="country" onchange="dependentCountry(this.value)" required>
                    <option selected disabled>Select Country</option>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value='.$row['country'].'>'.$row['country'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="infofield">
                <label for="city">City</label>
                <select name="city" id="city" autocomplete="off" onchange="dependentCity(this.value)" required>
                    <option value="" disabled selected>Select City</option>
                </select>
            </div>
            <div class="infofield">
                <label for="district">Disctrict</label>
                <select name="district" id="district" autocomplete="off" onchange="dependentDistrict(this.value)" required>
                    <option value="" selected disabled>Select Disctrict</option>
                </select>
            </div>
            <div class="infofield">
                <label for="hospital">Hospital</label>
                <select name="hospital" id="hospital" autocomplete="off" onchange="dependentHospital(this.value)" required>
                    <option value="" selected disabled>Select Hospital</option>
                </select>
            </div>
            <div class="infofield">
                <label for="speciality">Speciality</label>
                <select name="speciality" id="speciality" autocomplete="off" onchange="dependentSpeciality(this.value)" required>
                    <option value="" selected disabled>Select Speciality</option>
                </select>
            </div>
            <div class="infofield">
                <label for="doctor">Doctor</label>
                <select name="doctor" id="doctor" autocomplete="off" onchange="dependentDoctor(this.value)" required>
                    <option value="" selected disabled>Select Doctor</option>
                </select>
            </div>
            <div class="infofield">
                <label for="date">Date</label>
                <select name="date" id="date" autocomplete="off" onchange="dependentDate(this.value)" required>
                    <option value="" selected disabled>Select Date</option>
                </select>
            </div>
            <div class="infofield">
                <label for="time">Time</label>
                <select name="time" id="time" autocomplete="off" onchange="dependentTime(this.value)" required>
                    <option value="" selected disabled>Select Time</option>
                </select>
            </div>
            <input class="submitapp" type="submit" name="submit" value="Take Appointment">
        </form>
        </div>
    </div>
    <script type="text/javascript">
        function dependentCountry(id){
            $('#city').html('');
            $('#district').html('<option value="" selected disabled>Select District</option>');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { country_id : id},
                success: function(data){
                    $('#city').html(data);
                }
            })
        }

        function dependentCity(id){
            $('#district').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { city_id : id},
                success: function(data){
                    $('#district').html(data);
                }
            })
        }

        function dependentDistrict(id){
            $('#hospital').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { district_id : id},
                success: function(data){
                    $('#hospital').html(data);
                }
            })
        }

        function dependentHospital(id){
            $('#speciality').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { hospital_id : id},
                success: function(data){
                    $('#speciality').html(data);
                }
            })
        }

        function dependentSpeciality(id){
            $('#doctor').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { speciality_id : id},
                success: function(data){
                    $('#doctor').html(data);
                }
            })
        }

        function dependentDoctor(id){
            $('#date').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { doctor_id : id},
                success: function(data){
                    $('#date').html(data);
                }
            })
        }
        function dependentDate(id){
            $('#time').html('');
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { date_id : id},
                success: function(data){
                    $('#time').html(data);
                }
            })
        }
        function dependentTime(id){
            $.ajax({
                type:'post',
                url: 'appdata.php',
                data: { time_id : id}
            })
        }
    </script>
</body>
</html>
<?php
    if(isset($_POST['submit'])) {
        if(isset($_SESSION['country_id']) 
        && isset($_SESSION['city_id']) 
        && isset($_SESSION['district_id'])
        && isset($_SESSION['hospital_id']) 
        && isset($_SESSION['speciality_id']) 
        && isset($_SESSION['doctor_id']) 
        && isset($_SESSION['date_id'])
        && isset($_SESSION['time_id'])) 
        {
            $query= "INSERT INTO appointmentdata VALUES (NULL,".$_SESSION['userid'].",".$_SESSION['temphospid'].",\"".$_SESSION['date_id']."\",\"".$_SESSION['time_id']."\")"; 
            $result = $conn->query($query);
            if (!$result) die ("Database access failed: " . $conn->error);
            $_SESSION['country_id'] = NULL;
            $_SESSION['city_id'] = NULL;
            $_SESSION['district_id'] = NULL;
            $_SESSION['hospital_id'] = NULL;
            $_SESSION['speciality_id'] = NULL;
            $_SESSION['doctor_id'] = NULL;
            $_SESSION['date_id'] = NULL;
            $_SESSION['time_id'] = NULL;
        }
    }
?>