<?php
session_start();
require_once("connect.php");
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {

    header('Location: doctorPage.php');
    exit();
}
$SSN = $_POST['doctorssn'];
$password = $_POST['password'];

$error = '';



if (empty($SSN)) {
    $error .= '<p class="error">Please enter your Number.</p>';
}

if (empty($password)) {
    $error .= '<p class="error">Please enter password.</p>';
}
if (empty($error)) {

    if ($query = $conn->prepare("SELECT FirstName,DoctorSSN,password FROM doctor WHERE DoctorSSN = ?")) {

        $query->bind_param('i', $SSN);
        $query->execute();
        $query->bind_result($name, $doctorSSN, $pass);
        $row = $query->fetch();

        if ($row) {

            if (password_verify($password, $pass)) {

                $_SESSION["SSN"] = $doctorSSN;
                $_SESSION["name"] = $name;
                $_SESSION['loggedIn'] = true;





                header("Location: doctorPage.php ");
                exit;
            } else {
                echo '<p class="error">The password is not valid.</p>';
            }
        } else {
            echo '<p class="error">No User exist with that number.</p>';
        }
    }
}
