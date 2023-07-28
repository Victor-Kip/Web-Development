<?php

session_start();
if ($_SESSION['PatientSSN']) {
    echo "Welcome user " . $_SESSION['PatientSSN'];
} else {
    header("location: patlogin.php");
    exit();
}
?>
<a href="logout.php">LogOut</a>

<?php
require_once("connect.php");

// Add patient
if (isset($_POST['Submit'])) {
    // Get other information from the form
    $ConsultationId = $_POST['ConsultationId'];
    $PatientSSN = $_SESSION['PatientSSN'];
    $DoctorSSN = $_POST['DoctorSSN'];
    $Issue = $_POST['Issue'];
    $CDate = $_POST['CDate'];
    $Remark = $_POST['Remark'];

    // Insert the data into the "consultation" table
    $query = "INSERT INTO Consultation (ConsultationID, PatientSSN, DoctorSSN, Issue, CDate, Remark) VALUES ('$ConsultationId', '$PatientSSN', '$DoctorSSN', '$Issue', '$CDate', '$Remark')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            window.onload = function() {
                alert('Successfully sent to the doctor');
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
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="consulstyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Consultation</title>
</head>

<body>
    <div class="hero">
        <nav>
            <h2 class="logo">Honey<span>Meds</span></h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="http://localhost/phpcode/WebAppProj/index.php#about-us">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
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
                        <!-- Replace the input box with a dropdown list -->
                        <div class="input-box">
                            <span class="details">Doctor</span>
                            <select name="DoctorSSN" required>
                                <option value="">Select a Doctor</option>
                                <?php
                                // Retrieve doctors' data from the database
                                $sql = "SELECT DoctorSSN, FirstName FROM doctor";
                                $result = $conn->query($sql);

                                // Generate the dropdown list
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Display the Doctor's name in the dropdown, but pass the DoctorSSN as the value
                                        echo '<option value="' . $row["DoctorSSN"] . '">' . $row["FirstName"] . ' - ' . $row["DoctorSSN"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <span class="details">Issue</span>
                            <textarea name="Issue" placeholder="How are you feeling today?" required></textarea>
                        </div>
                        <div class="input-box">
                            <span class="details">Consultation Date</span>
                            <input type="date" name="CDate" placeholder="The date today" required>
                            <script>
                                let today = new Date().toISOString().substr(0, 10);
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
                        <input type="submit" name="Check" value="Check Prescription">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['Check'])) {

        $patientSSN = mysqli_real_escape_string($conn, $_SESSION['PatientSSN']);

        $query1 = "SELECT
        Remark,
        TradeName,
        Dosage,
        Duration,
        prescription_drug.Cost
    FROM
        consultation 
    INNER JOIN prescription  ON consultation.ConsultationID = prescription.ConsultationID
    INNER JOIN prescription_drug  ON prescription.PrescriptionID = prescription_drug.PrescriptionID
    INNER JOIN drug ON prescription_drug.DrugNumber = drug.DrugID WHERE consultation.PatientSSN='$patientSSN';";
        $result1 = mysqli_query($conn, $query1);



        echo '<div class="row mt-5">';
        echo '    <div class="col">';
        echo '        <div class="card mt-5">';
        echo '            <div class="card-header">';
        echo '                <h2 class="display-6 text-center">The Prescription:</h2>';
        echo '            </div>';
        echo '            <div class="card-body">';
        echo '                <table class="table table-bordered text-center">';
        echo '                    <tr class="bg-dark text-white">';
        echo '                        <td> Remark </td>';
        echo '                        <td> DrugName </td>';
        echo '                        <td> Dosage</td>';
        echo '                        <td> Duration</td>';
        echo '                        <td> Cost</td>';
        echo '                    </tr>';

        while ($row = mysqli_fetch_assoc($result1)) {
            echo '                    <tr>';
            echo '                        <td>' . $row['Remark'] . '</td>';
            echo '                        <td>' . $row['TradeName'] . '</td>';
            echo '                        <td>' . $row['Dosage'] . '</td>';
            echo '                        <td>' . $row['Duration'] . '</td>';
            echo '                        <td>' . $row['Cost'] . '</td>';
            echo '                    </tr>';
        }

        echo '                </table>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';

        $conn->close();
    }
    ?>



</body>

</html>