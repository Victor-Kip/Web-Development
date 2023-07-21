
<?php
$servername = "localhost";
$username = "root";
$password  = "MyOscVic2@";
$database = "HospitalDB";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	echo "<br>";
}
?>