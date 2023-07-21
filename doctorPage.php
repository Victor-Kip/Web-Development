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
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: "montserrat", sans-serif;

            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);
            }

            .form-container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h3 {
                font-size: 24px;
                color: #333;
                text-align: center;
                margin-bottom: 20px;
            }

            form {
                width: 100%;
            }

            p {
                font-size: 16px;
                color: #333;
                margin: 10px 0;
            }

            .prescription-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .input-group {
                flex: 1;
                margin-right: 10px;
            }

            label {

                font-size: 25px;
                color: rgb(93, 20, 20);
                font-weight: bold;

            }

            .hero {
                height: 20vh;
                width: 100%;
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);
                background-size: cover;
                background-position: center;
            }


            input[type='number'] {
                width: 10%;
                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            input[type='text'] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 3px;
                font-size: 16px;
            }

            input[type='date'] {
                display: block;
                margin: 0 auto;
                width: 30%;
                padding: 12px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;

            }

            input[type='submit'] {
                display: block;
                margin: 0 auto;
                width: 30%;
                padding: 12px;
                border: none;
                border-radius: 5px;
                background-color: rgb(128, 128, 71);
                color: #fff;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;

            }

            input[type='submit']:hover {
                background-color: rgb(100, 100, 55);

            }

            .username {
                position: absolute;
                top: 0;
                right: 0;
                padding: 10px;
                background-color: antiquewhite;
                border-bottom-right-radius: 10px;
            }

            .tableContainer {
                max-width: 600px;
                margin: 0 auto;
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
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
            }

            span {
                color: #ea1538;
            }

            nav ul li {
                list-style-type: none;
                display: inline-block;
                padding: 10px 20px;
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
        </style>

    </head>
    <div class="hero">

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