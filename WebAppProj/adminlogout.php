<?php

session_start();
unset($_SESSION['AdminSSN']);
header("location: adminlogin.php")

?>