<?php
require_once("connect.php");
print_r($_POST);
$firstName = $_POST['firstname'];
$secondName = $_POST['secondname'];
$SSN = $_POST['socialsecuritynumber'];
$dob = $_POST['birthdate'];
$pharmacy = $_POST['pharma'];
$yearsPractised = $_POST["yearspractised"];
$password = $_POST['password'];
$confirmpass = $_POST['confirmpass'];
if ($password == $confirmpass) {
    $passhash = password_hash($password, PASSWORD_DEFAULT);

    $today = date("Y-m-d");
    $diff = date_diff(date_create($dob), date_create($today));
    $age = $diff->format('%y');

    $sql = "INSERT INTO pharmacist VALUES('$SSN','$firstName','$secondName','$age','$pharmacy','$yearsPractised','$passhash')";
    if ($conn->query($sql) === TRUE) {
        echo "Record added";
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: pharmacistlogin.html");
} else {
    header("Location: pharmacistSignup2.php?error=passwords");
    exit();
}
