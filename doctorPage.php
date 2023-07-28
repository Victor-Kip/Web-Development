<?php
session_start();
if (isset($_SESSION["doctorssn"])) {
    $doctorSSN = $_SESSION["doctorssn"];
} else {
    header("Location: DoctorLogin.html");
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>doctorPage</title>
        <styles>
            <link rel="stylesheet" type="text/css" href="doctorPageStyles.css">
        </styles>

    </head>
    <div class="hero">

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
                <span class="name"><?php echo $_SESSION['name']; ?></span>
                <a href="doclogout.php">LogOut</a>
            </div>
            <?php endif; ?><?php ?>


            <h1> Welcome to the doctor page, what would you like to do?.</h1>
            <h3>View Today's Submissions</h3>
            <form method="post" action="">
                <input type="submit" name="select" value="View Submissions">
            </form>
            <?php
            if (isset($_POST['select'])) {
                require_once("connect.php");
                $today = date("Y-m-d");
                $query  = $conn->prepare("SELECT ConsultationID, PatientSSN, Issue FROM consultation WHERE CDate = ? AND DoctorSSN = ?");
                if (!$query) {
                    echo "Error" . $conn->error;
                } else {
                    $query->bind_param('si', $today, $doctorSSN);
                    $query->execute();
                    $result = $query->get_result();
                    if ($result->num_rows > 0) {
                        echo "<div class = 'tableContainer'>";
                        echo "<table>";
                        echo "<tr><th>ConsultationID</th><th>PatientSSN</th><th>Issue</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ConsultationID"] . "</td>";
                            echo "<td>" . $row["PatientSSN"] . "</td>";
                            echo "<td>" . $row["Issue"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "<p class ='notify'>No submissions have been made today</p> .";
                    }
                }
            }
            ?>


            <h3>Make a remark</h3>
            <div class="remark">
                <form method="post" action="">
                    <label for="Id">ConsultationID:</label>
                    <input type='number' name='id' id='Id'>
                    <label for="Remark">Remark:</label>
                    <textarea name="remark" id="Remark"></textarea>
                    <input type='submit' name='submit' value="Post">
                </form>
                <?php
                if (isset($_POST['submit']) && isset($_POST['remark']) && isset($_POST['id'])) {
                    require_once("connect.php");
                    $remark = $_POST['remark'];
                    $id = $_POST['id'];

                    $sql = "UPDATE consultation SET Remark = ? WHERE ConsultationId = ?;";
                    $query = $conn->prepare($sql);
                    $query->bind_param("si", $remark, $id);
                    if ($query->execute()) {
                        echo "Record updated successfully.";
                    } else {
                        echo "Error updating record: " . $query->error;
                    }
                }
                ?>
                </form>

                <div class="form-container">
                    <h3>Add a prescription</h3>
                    <form method="post" action="">
                        <p>
                            <label for="ConsultationID">Consultation ID:</label>
                            <input type="text" name="consultationid" id="ConsultationID" required>
                        </p>
                        <p>Enter the following details about the prescription</p>
                        <div class="prescription-row">
                            <div class="input-group">
                                <label for="drugName">Drug Name:</label>
                                <input type="text" name="drugName" id="drugName" required>
                            </div>
                            <div class="input-group">
                                <label for="dosage">Dosage:</label>
                                <input type="text" name="dosage" id="dosage">
                            </div>
                            <div class="input-group">
                                <label for="duration">Duration:</label>
                                <input type="text" name="duration" id="duration">
                            </div>
                        </div>

                </div>
                <input type="submit" name="add_prescription" value="Add Prescription">
                </form>
            </div>
            <?php
            if (
                isset($_POST['add_prescription']) && isset($_POST['consultationid'])  &&   isset($_POST['drugName'])
                && isset($_POST['dosage']) && isset($_POST['duration'])
            ) {
                require_once("connect.php");
                $id = $_POST['consultationid'];
                $today = date("Y-m-d");
                $drugNames = $_POST['drugName'];
                $dosages = $_POST['dosage'];
                $durations = $_POST['duration'];

                $insertPrescription = "INSERT INTO prescription (ConsultationId, PrescriptionDate) VALUES ('$id', '$today')";

                if ($conn->query($insertPrescription)) {

                    $prescriptionId = $conn->insert_id;


                    $selectDrugIdQuery = "SELECT DrugID FROM drug WHERE TradeName = ?";
                    $stmt = $conn->prepare($selectDrugIdQuery);
                    $stmt->bind_param("s", $drugNames);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $drugId = $row['DrugID'];



                        $insertDrugs = "INSERT INTO prescription_drug (PrescriptionID, DrugNumber, Dosage, Duration) 
                VALUES (?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertDrugs);
                        $stmt->bind_param("iiss", $prescriptionId, $drugId, $dosages, $durations);
                        $stmt->execute();
                        echo "<p>Prescription sent to the pharmacist<p>";
                    } else {
                        echo "An error occurred while adding drug details: "  . $conn->error;
                    }
                } else {
                    echo "An error occurred while adding prescription: " . $conn->error;
                }
            }


            ?>
            <h3>View History </h3>
            <form method="post" action="">
                <input type="date" name="Date" id="date">
                <input type="submit" name="View_History" value="View History">

            </form>
            <?php

            if (isset($_POST['View_History']) && isset($_POST['Date'])) {
                require_once("connect.php");
                $date = $_POST['Date'];
                $doctorSSN = $_SESSION["doctorssn"];

                $db = $conn->prepare("SELECT ConsultationID, PatientSSN, Issue,Remark FROM consultation WHERE CDate = ? AND DoctorSSN = ?");
                if (!$db) {
                    echo "Error: " . $conn->error;
                } else {
                    $db->bind_param('si', $date, $doctorSSN);
                    $db->execute();
                    $result = $db->get_result();

                    if ($result->num_rows > 0) {
                        echo "<div class = 'tableContainer'>";
                        echo "<table>";
                        echo "<tr><th>ConsultationID</th><th>PatientSSN</th><th>Issue</th><th>Remark</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ConsultationID"] . "</td>";
                            echo "<td>" . $row["PatientSSN"] . "</td>";
                            echo "<td>" . $row["Issue"] . "</td>";
                            echo "<td>" . $row["Remark"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "No record found.";
                    }
                }
            }
            ?>


        </body>

        </html>