<?php
session_start();
if (isset($_SESSION["SSN"])) {
    $pharmaSSN = $_SESSION["SSN"];
} else {
    header("Location: pharmacistlogin.html");
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>pharmacistPage</title>

        <style>
            h1 {
                font-size: 40;
                color: brown;
            }

            h3 {
                font-size: 30;
                color: rgb(48, 2, 18);
            }

            p {
                font-size: 30;
            }

            a {
                color: red;
            }


            body {


                height: 100vh;
                width: 100%;
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);



            }

            textarea {
                width: 30%;
                height: 5%;
            }


            .name {
                float: right;
                color: red;
                font-size: 35px;
                border-color: black;
            }



            input[type='text'],
            input[type='number'] {

                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            input[type='submit'] {
                width: 15%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: rgb(128, 128, 71);
                color: #fff;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
            }
        </style>

    </head>

    <body>
        <div class="username">
            <span class="name"><?php echo $_SESSION['name']; ?></span>
        </div>
        <?php endif; ?><?php ?>

        <h1> Welcome to the pharmacist page, what would you like to do?.</h1>
        <h3>View Today's Submissions</h3>
        <form method="post" action="">
            <input type="submit" name="select" value="View Submissions">
        </form>
        <?php
        if (isset($_POST['select'])) {
            $today = Date("Y-m-d");
            $view = "SELECT  PrescriptionID,doctor.FirstName AS doctorName, patient.FirstName AS patientName FROM prescription_drug JOIN prescription ON 
            prescription_drug.prescriptionID = prescription.prescriptionID JOIN consultation ON prescription.ConsultationId = consultation.ConsultationId
             JOIN patient ON consutltation.PatientSSN = patient.PatentSSN Join doctor ON patient.PrimaryDoctor = doctor.doctorSSN WHERE prescription.PrescriptionDate = ?";
            $query = $conn->prepare($view);
            if (!$query) {
                echo "An error occured" . $conn->error;
            } else {
                $query->bind_param('s', $today);
                $query->execute();
                $result = $query->get_result();

                if ($result->numrows > 0) {
                    echo "<table>";
                    echo "<tr><th>Date</th><th>PrescriptionID</th><th>Doctor</th><th>Patient</th></tr>";


                    while ($row->fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['PrescriptionDate'] . "</td>";
                        echo "<td>" . $row['PrescriptionID'] . "</td>";
                        echo "<td>" . $row['doctorName'] . "</td>";
                        echo "<td>" . $row['patientName'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
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
        if (isset($_POST['viewdetails']) && isset($_POST['prescriptionId'])) {
            require_once('connect.php');
            $id = $_POST['prescrptionid'];
            $query = "SELECT pd.DrugNumber, d.TradeName, pd.Dosage, pd.Duration FROM prescription_drug pd JOIN drug d ON pd.DrugNumber = d.DrugID  WHERE pd.PrescriptionID = '?'";

            $results = mysqli_query($conn, $query);
            if ($results && mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>";
                    echo "<td>" . $row['drugname'] . "</td>";
                    echo "<td>" . $row['Dosage'] . "</td>";
                    echo "<td>" . $row['Duration'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No prescription data found.</td></tr>";
            }

            echo "</table>";
        }
        ?>
        <h2>Dispense drugs</h2>
        <p>Enter a presciption id dispense drugs to a patient</p>
        <form action="" method="post">
            <p> <label for="PrescriptionId">ID</label>
                <input type="Number" name="prescriptionid" id="PrescriptionId">
            </p>
            <input type="submit" name="dispense" value="Enter">
        </form>
        <?php
        if (isset($_POST['dispense']) && isset($_POST['prescriptionId'])) {
            require_once('connect.php');
            $id = $_POST['prescriptionId'];

            $query = "SELECT pd.DrugNumber, d.TradeName, pd.Dosage, pd.Duration FROM prescription_drug pd JOIN drug d ON pd.DrugNumber = d.DrugID  WHERE pd.PrescriptionID = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);

            if ($results && mysqli_num_rows($results) > 0) {
                echo "<table>";
                echo "<tr><th>Drug</th><th>Dosage</th><th>Duration</th></tr>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>";
                    echo "<td>" . $row['TradeName'] . "</td>";
                    echo "<td>" . $row['Dosage'] . "</td>";
                    echo "<td>" . $row['Duration'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p>The above drugs will be dispensed</p>";
                echo "<form action='' method='post'>";
                echo "<input type='submit' name='dispensed' value='Dispense'>";
                echo "</form>";
            } else {
                echo "<p>No prescription data found.</p>";
            }
        }


        if (isset($_POST['dispensed'])) {

            $query = "SELECT DrugNumber FROM prescription_drug WHERE PrescriptionID = $prescriptionId";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $drugNumber = $row['DrugNumber'];
                $queryDrug = "SELECT DrugID, Cost FROM drugs WHERE DrugNumber = $drugNumber";
                $resultDrug = mysqli_query($conn, $queryDrug);
                $rowDrug = mysqli_fetch_assoc($resultDrug);
                $drugId = $rowDrug['DrugID'];
                $cost = $rowDrug['Cost'];
                $updateQuery = "UPDATE prescription_drug SET DrugID = $drugId, Cost = $cost WHERE PrescriptionID = $prescriptionId AND DrugNumber = $drugNumber";
                mysqli_query($conn, $updateQuery);
            }
            if (mysqli_affected_rows($conn) > 0) {
                echo "Prescription drug costs updated successfully for PrescriptionID $prescriptionId.";
            } else {
                echo "No prescription drug costs were updated for PrescriptionID $prescriptionId.";
            }
        }

        ?>
        <p>Click<a href="managedrugs.php"=>here</a> to manage the drug records</p>