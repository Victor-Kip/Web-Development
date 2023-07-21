<?php

session_start();
unset($_SESSION['doctorssn']);
unset($_SESSION["name"]);
unset($_SESSION['loggedIn']);
header("location: index.php");
