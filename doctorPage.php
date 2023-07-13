<?php
session_start();
if (isset($_SESSION["SSN"])) {
    $doctorSSN = $_SESSION["SSN"];
} else {
    echo "error";
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>doctorPage</title>
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

        <h1> Welcome to the doctor page, what would you like to do?.</h1>
        <h3>View Today's Submissions</h3>
        <form method="post" action="">
            <input type="submit" name="select" value="View Submissions">
        </form>
        <?php
        if (isset($_POST['select'])) {
            require_once("connect.php");
            $today = date("Y-m-d");
            echo $today;
            $query  = $conn->prepare("SELECT ConsultationID, PatientSSN, Issue FROM consultation WHERE CDate = ?");
            if (!$query) {
                echo "Error" . $conn->error;
            } else {
                $query->bind_param('s', $today);
                $query->execute();
                $result = $query->get_result();
                if ($result->num_rows > 0) {
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
                } else {
                    echo "No submissions have been made .";
                }
            }
        }
        ?>


        <h3>Make a remark</h3>
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
        <h3>View History </h3>
        <form method="post" action="">
            <input type="text" name="Date" id="date">
            <input type="submit" name="View_History" value="View History">

        </form>
        <?php

        if (isset($_POST['View_History']) && isset($_POST['Date'])) {
            require_once("connect.php");
            $date = $_POST['Date'];
            echo $doctorSSN;

            $db = $conn->prepare("SELECT ConsultationID, PatientSSN, Issue,Remark FROM consultation WHERE CDate = ? AND DoctorSSN = ?");
            if (!$db) {
                echo "Error: " . $conn->error;
            } else {
                $db->bind_param('si', $date, $doctorSSN);
                $db->execute();
                $result = $db->get_result();

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>ConsultationID</th><th>PatientSSN</th><th>Issue</th><th>Remark</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ConsultationID"] . "</td>";
                        echo "<td>" . $row["PatientSSN"] . "</td>";
                        echo "<td>" . $row["Issue"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No record found.";
                }
            }
        }
        ?>

        <p>Edit my details? <a href="Editdoctor.html"> click here</a></p>
        <p>Delete my account? <a href="Deletedoctor.html"> click here</a></p>


    </body>

    </html>