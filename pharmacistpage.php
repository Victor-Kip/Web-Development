<?php
session_start();
if (isset($_SESSION["SSN"])) {
    $pharmaSSN = $_SESSION["SSN"];
} else {
    echo "error";
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>pharmacistPage</title>
        <style>
            .name {
                float: right;
                color: red;
                font-size: 35px;
                border-color: black;
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
        <?
        if (isset($_POST['select'])) {
            $today = Date("Y-m-d");
            $view = "SELECT  PrescriptionID,doctor.FirstName AS doctorName, patient.FirstName AS patientName FROM prescription_drug JOIN prescription ON 
            prescription_drug.prescriptionID = prescription.prescriptionID JOIN consultation ON prescription.ConsultationId = consultation.ConsultationId
             JOIN patient ON consutltation.PatientSSN = patient.PatentSSN Join doctor ON patient.PrimaryDoctor = doctor.doctorSSN WHERE prescription.PrescriptionDate = ?";
            $query = $conn->prepare($view);
            if (!$query) {
                echo "An error occured" . $query . $conn->error;
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
        <h4>View detailed prescription deatails</h4>
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
        <p>Click<a href="managedrugs.php"=>here</a> to manage the drug records</p>