<?php

session_start();
if ($_SESSION['PatientSSN']) {
  echo "Welcome user " . $_SESSION['PatientSSN'];
} else {
  header("location: patlogin.php");
}
?>
<a href="logout.php">LogOut</a>

<?php
require_once("connect.php");
// Add patient
if (isset($_POST['Submit'])) {


  $ConsultationId = $_POST['ConsultationId'];
  $PatientSSN = $_SESSION['PatientSSN'];
  $DoctorSSN = $_POST['DoctorSSN'];
  $Issue = $_POST['Issue'];
  $CDate = $_POST['CDate'];
  $Remark = $_POST['Remark'];




  $query = "INSERT INTO Consultation VALUES ('$ConsultationId', '$PatientSSN','$DoctorSSN','$Issue','$CDate','$Remark')";


  if (mysqli_query($conn, $query)) {
    echo "<script>
            window.onload = function() {
                alert('Successfuly sent to the doctor');
                window.location.href = 'consultation.php';
            };
        </script>";
  } else {
    echo "<script>
            window.onload = function() {
                alert('Error in submission');
                window.location.href = 'consultation.php';
            };
        </script>";
  }
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="consulstyles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultation</title>
</head>

<body>

  <div class="hero">
    <nav>
      <h2 class="logo">Honey<span>Meds</span></h2>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <button type="button" onclick="window.location.href = 'patlogin.php';">Login</button>
    </nav>



    <div class="container">
      <div class="title">Get a consultation today</div>
      <div class="content">
        <form action="consultation.php" method="post">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Consultation Id</span>
              <input type="number" name="ConsultationId" placeholder="Enter the consultation number" required>
            </div>

            <div class="input-box">
              <span class="details">Doctor SSN</span>
              <input type="number" name="DoctorSSN" placeholder="Enter the DoctorSSN" required>
            </div>
            <div class="input-box">
              <span class="details">Issue</span>
              <textarea name="Issue" placeholder="How are you feeling today?" required></textarea>
            </div>
            <div class="input-box">
              <span class="details">Consultation Date</span>
              <input type="date" name="CDate" placeholder="The date today" required>
              <script>
                let today = new Date().toISOString().subtr(0, 10);
                document.querySelector("#datepicker").value = today;
              </script>
            </div>
            <div class="input-box">
              <span class="details"></span>
              <input type="text" name="Remark" hidden>
            </div>
          </div>

          <div class="button">
            <input type="submit" name="Submit" value="Submit">


          </div>
        </form>
      </div>
    </div>

  </div>




</body>

</html>