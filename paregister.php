<?php
require_once("connect.php");

// Add patient
if (isset($_POST['register'])) {
    $PatientSSN = $_POST['PatientSSN'];
    $FirstName = $_POST['FirstName'];
    $SecondName = $_POST['SecondName'];
    $Address = $_POST['Address'];
    $Age = $_POST['Age'];
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];
    $Allergies = $_POST['Allergies'];
    $PrimaryDoctor = $_POST['PrimaryDoctor'];
    $Password = $_POST['Password'];



    $query = "INSERT INTO Patients VALUES ('$PatientSSN', '$FirstName','$SecondName','$Address','$Age','$Height','$Weight','$Allergies','$PrimaryDoctor','$Password')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            window.onload = function() {
                alert('Successfully Registered');
                window.location.href = 'patlogin.php';
            };
        </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Patient Registration Form</title>
    <link rel="stylesheet" href="paregister.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="http://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans: ital, wght@0,100; 0,30 0;0,400;0,500; 0,600; 0,700; 1, 100; 1, 200; 1,300; 1,400; 1,500; 1,600;1,700&family=Montserrat: wght@700; 800; 900&display=swap" rel="stylesheet">

</head>

<body>

    <div class="hero">
        <nav>
            <h2 class="logo">Honey<span>Meds</span></h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <button type="button" onclick="window.location.href = 'patlogin.php';">Login</button>
        </nav>
    </div>


    <div class="container">
        <div class="title">Patient Registration</div>
        <div class="content">
            <form action="paregister.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Patient SSN</span>
                        <input type="number" name="PatientSSN" placeholder="Enter your Patient SSN" required>
                    </div>
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" name="FirstName" placeholder="Enter your First Name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Second Name</span>
                        <input type="text" name="SecondName" placeholder="Enter your Second Name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="Address" placeholder="Enter your Address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Age</span>
                        <input type="number" name="Age" placeholder="Enter your Age" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Height</span>
                        <input type="number" name="Height" placeholder="Enter your Height" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Weight</span>
                        <input type="number" name="Weight" placeholder="Enter your Weight" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Allergies</span>
                        <input type="text" name="Allergies" placeholder="Enter your Allergies" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Primary Doctor</span>
                        <input type="text" name="PrimaryDoctor" placeholder="Enter your Primary Doctor" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="Password" placeholder="Enter your Password" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="register" value="Register">
                </div>
            </form>
        </div>
    </div>

</body>

</html>