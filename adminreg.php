<!DOCTYPE html>
<html>
<head>
	<title>Admin Reigistration</title>
</head>

<body>
	<p>Sign up as an administrator</p>

	<form action="adminreg.php" method="POST">

		Admin SSN:<br>
		<input type="number" name="AdminSSN" placeholder="Admin SSN">
		<br>

		First Name:<br>
		<input type="text" name="FirstName" placeholder="First Name">
		<br>

		Last Name:<br>
		<input type="text" name="LastName" placeholder="Last Name">
		<br>

		Email:<br>
		<input type="text" name="Email" placeholder="Email">
		<br>

		Password:<br>
		<input type="password" name="Password" placeholder="Your password">
		<br>

		<button name = "Submit">Submit</button>

	</form>
</body>
</html>


<?php 

require_once("connection.php");


// Add patient
if(isset($_POST['Submit'])) {


$AdminSSN = $_POST['AdminSSN'];
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

print_r($_POST);

$query = "INSERT INTO Administrator VALUES ('$AdminSSN', '$FirstName','$LastName','$Email','$Password')";


    if (mysqli_query($conn, $query)) {
        header("location: ");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

}


$conn->close();

 ?>