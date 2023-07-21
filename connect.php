<html>

<head>
	<title>My Page</title>
</head>

<body>
	<script>
		function showPopup() {
			alert("Request successful");
		}
	</script>
</body>

</html>
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
echo "<script>showPopup();</script>";
echo "<br>"; ?>