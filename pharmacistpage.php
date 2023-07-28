<?php
session_start();
if (isset($_SESSION["pharmassn"])) {
    $pharmaSSN = $_SESSION["pharmassn"];
} else {
    header("Location: pharmacistlogin.html");
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>pharmacistPage</title>

        <styles>
            <link rel="stylesheet" type="text/css" href="pharmacistPageStyles.css">
        </styles>

    </head>

    <body>
        <div class="hero">
            <nav>
                <h2 class="logo">Honey<span>Meds</span></h2>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href=" index.php#about-us">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>

            </nav>
        </div>
        <div class="username">
            <span><?php echo $_SESSION['name']; ?></span>
            <a href="pharmalogout.php">LogOut</a>
        </div>
        <?php endif; ?><?php ?>

        <h1> Welcome to the pharmacist page, what would you like to do?.</h1>
        <h3>View Today's Submissions</h3>
        <form method="post" action="">
            <input type="submit" name="select" value="View Submissions">
        </form>
        <?php
        if (isset($_POST['select'])) {
            require_once('connect.php');
            $today = Date("Y-m-d");
            $view = "SELECT  prescription.PrescriptionDate ,prescription_drug.PrescriptionID,doctor.FirstName AS doctorName, patients.FirstName AS patientName FROM prescription_drug JOIN prescription ON 
            prescription_drug.prescriptionID = prescription.prescriptionID JOIN consultation ON prescription.ConsultationId = consultation.ConsultationId
             JOIN patients ON consultation.PatientSSN = patients.PatientSSN Join doctor ON consultation.DoctorSSN = doctor.DoctorSSN WHERE prescription.PrescriptionDate = ? AND prescription.pharmacyName = (SELECT Pharmacy FROM
             pharmacist WHERE PharmaSSN = $pharmaSSN) ";
            $query = $conn->prepare($view);
            if (!$query) {
                echo "An error occured" . $conn->error;
            } else {
                $query->bind_param('s', $today);
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    echo "<div class = 'tableContainer'>";
                    echo "<table>";
                    echo "<tr><th>Date</th><th>PrescriptionID</th><th>Doctor</th><th>Patient</th></tr>";


                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['PrescriptionDate'] . "</td>";
                        echo "<td>" . $row['PrescriptionID'] . "</td>";
                        echo "<td>" . $row['doctorName'] . "</td>";
                        echo "<td>" . $row['patientName'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "There are no submissions today";
                }
            }
        }
        ?>
        <h4>View detailed prescription </h4>
        <form method="post" action="">
            <P>
                <label for="PresciptionId">PrescriptionId:</label>
                <input type="number" name="prescriptionid" id="PrescriptionId">
            </P>
            <input type="submit" name="Viewdetails" value="View Details">
        </form>
        <?php
        if (isset($_POST['Viewdetails']) && isset($_POST['prescriptionid'])) {
            require_once('connect.php');
            $id = $_POST['prescriptionid'];
            $query = "SELECT  prescription_drug.PrescriptionID,drug.TradeName, prescription_drug.Dosage, prescription_drug.Duration FROM prescription_drug  JOIN drug 
             ON prescription_drug.DrugNumber = drug.DrugID  WHERE prescription_drug.PrescriptionID = $id";

            $results = mysqli_query($conn, $query);
            if ($results && mysqli_num_rows($results) > 0) {
                echo "<div class = 'tableContainer'>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Drug</th><th>Dosage</th><th>Duration</th></tr>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>";
                    echo "<td>" . $row['PrescriptionID'] . "</td>";
                    echo "<td>" . $row['TradeName'] . "</td>";
                    echo "<td>" . $row['Dosage'] . "</td>";
                    echo "<td>" . $row['Duration'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No prescription data found.</td></tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        ?>
        <h2>Dispense drugs</h2>
        <p>Enter a prescription id to dispense drugs to a patient</p>
        <form action="" method="post">
            <p> <label for="PrescriptionId">ID</label>
                <input type="Number" name="prescriptionid" id="PrescriptionId">
            </p>
            <input type="submit" name="dispense" value="Enter">
        </form>
        <?php
        if (isset($_POST['dispense']) && isset($_POST['prescriptionid'])) {
            require_once("connect.php");
            $id = $_POST['prescriptionid'];
            $query = "SELECT DrugNumber FROM prescription_drug WHERE PrescriptionID = $id";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $drugNumber = $row['DrugNumber'];
                $queryDrug = "SELECT   drug.DrugID,drug.Cost FROM  drug JOIN prescription_drug ON prescription_drug.DrugNumber = drug.DrugID WHERE DrugNumber = $drugNumber;";

                $resultDrug = mysqli_query($conn, $queryDrug);
                if (!$queryDrug) {
                    echo "Error:" . $conn->error;
                } else {
                    $rowDrug = mysqli_fetch_assoc($resultDrug);

                    $cost = $rowDrug['Cost'];
                    $updateQuery = "UPDATE prescription_drug SET Cost = $cost WHERE PrescriptionID = $id AND DrugNumber = $drugNumber";

                    mysqli_query($conn, $updateQuery);
                }
                if (mysqli_affected_rows($conn) > 0) {
                    echo "Prescription drug costs updated successfully for PrescriptionID $id.";
                } else {
                    echo "No prescription drug costs were updated for PrescriptionID $id.";
                }
            }
        }

        ?>
        <p>Click<a href="managedrugs.php"=>here</a> to manage the drug records</p>