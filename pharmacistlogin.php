<?php
session_start();
require_once("connect.php");



$SSN = $_POST['pharmassn'];
$password = $_POST['password'];

$error = '';



if (empty($SSN)) {
    $error .= '<p class="error">Please enter your Number.</p>';
}

if (empty($password)) {
    $error .= '<p class="error">Please enter password.</p>';
}
if (empty($error)) {

    if ($query = $conn->prepare("SELECT FirstName,PharmaSSN,password FROM pharmacist WHERE PharmaSSN = ?")) {

        $query->bind_param('i', $SSN);
        $query->execute();
        $query->bind_result($name, $pharmaSSN, $pass);
        $row = $query->fetch();

        if ($row) {

            if (password_verify($password, $pass)) {

                $_SESSION["SSN"] = $pharmaSSN;
                $_SESSION["name"] = $name;
                $_SESSION['loggedIn'] = true;





                header("Location: pharmacistpage.php ");
                exit;
            } else {
                echo '<p class="error">The password is not valid.</p>';
            }
        } else {
            echo '<p class="error">No User exist with that number.</p>';
        }
    }
}
