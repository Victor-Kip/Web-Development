<?php
	$servername = "localhost";
	$database = "hospitaldb";
	$username = "root";
	$password = "pass1234";

	//create connection
	$conn = new mysqli($servername, $username, $password, $database);

	//check connection

/*if($conn -> connect_error){
	die("Connection Failed".mysqli_connect_error());
}
echo "Connection Successful";
*/

?>