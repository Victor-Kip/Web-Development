<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
</head>

<body>
	<p>Login into your account</p>

	<form action="adminlogin.php" method="POST">
		
		Admin SSN:<br>
		<input type="number" name="AdminSSN" placeholder="Admin SSN">
		<br>

		Password:<br>
		<input type="password" name="Password" placeholder="Password">
		<br>

		<button name="Submit">Submit</button>
		<br>

		<a href="http://localhost/phpcode/WebAppProj/adminreg.php">Don't have an account? Register</a>
	</form>

</body>

</html>

<?php
require_once("connection.php");

if(isset($_POST['Submit'])) {
    $AdminSSN = $_POST['AdminSSN'];
    $Password = $_POST['Password'];

    // Query the database to check if the user exists
    $query = "SELECT * FROM Administrator WHERE AdminSSN='$AdminSSN' AND Password='$Password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        session_start();
        $_SESSION['AdminSSN'] = $AdminSSN;
        header("Location: index.html"); // Redirect to success page
    } else {
        // Login failed
        echo "<script type = 'text/javascript'>alert('Invalid email or password');</script>";
    }
}


 ?>