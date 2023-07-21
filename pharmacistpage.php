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

        <style>
            .hero {
                height: 20vh;
                width: 100%;
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);
                background-size: cover;
                background-position: center;
            }

            nav {
                position: fixed;
                top: 0;
                left: 0;
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 10%;

            }

            .logo {
                color: white;
                font-size: 28px;
                margin: 0;
            }

            span {
                color: #ea1538;
            }

            nav ul li {
                list-style-type: none;
                display: inline-block;
                padding: 20px 20px;
            }

            nav ul li a {
                color: white;
                text-decoration: none;

                font-weight: bold;
            }

            nav ul li a:hover {
                color: #ea1538;
                transition: .3s;
            }

            .username {
                position: absolute;
                top: 0;
                right: 0;
                padding: 10px;
                background-color: antiquewhite;
                border-bottom-right-radius: 10px;
            }

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

            table {
                margin-top: 20px;
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
                padding: 10px;
            }

            .tableContainer {
                max-width: 600px;
                margin: 0 auto;
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
            }

            * {

                padding: 0;
                font-family: "montserrat", sans-serif;

            }
        </style>

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
             JOIN patients ON consultation.PatientSSN = patients.PatientSSN Join doctor ON patients.PrimaryDoctor = doctor.DoctorSSN WHERE prescription.PrescriptionDate = ?";
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