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

    print_r($_POST);

    $query = "INSERT INTO Patient VALUES ('$PatientSSN', '$FirstName','$SecondName','$Address','$Age','$Height','$Weight','$Allergies','$PrimaryDoctor','$Password')";


    if (mysqli_query($conn, $query)) {
        header("location: patlogin.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}


$conn->close();
