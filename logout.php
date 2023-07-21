<?php

session_start();
unset($_SESSION['PatientSSN']);
header("location: index.php");
