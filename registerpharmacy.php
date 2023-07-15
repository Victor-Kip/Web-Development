 <?php
   require_once("connect.php");
   $name = $_POST['pharmacyname'];
   $email = $_POST['email'];
   $tel = $_POST['phone'];
   $location = $_POST['location'];

   $sql = "INSERT INTO pharmacy VALUES('$name','$email','$tel','$location')";
   if ($conn->query($sql)) {
      echo "record added successfully";
   } else {
      echo "An error occured:" . $sql . $conn->error;
   }
   ?>