<?php
session_start();
if (isset($_SESSION["SSN"])) {
    $doctorSSN = $_SESSION["SSN"];
} else {
    echo "error";
}
if ($_SESSION['loggedIn']) : ?>

    <head>
        <title>Drugs</title>
        <styles>
            <link rel="stylesheet" type="text/css" href="managedrugs.css">
        </styles>


    </head>

    <body>
        <div class="username">
            <span><?php echo $_SESSION['name']; ?></span>
            <a href="pharmalogout.php">LogOut</a>
        </div>
        <?php endif; ?><?php ?>
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
        <h1> Welcome to the Drug Management page.</h1>
        <h2>View available drugs</h2>
        <form action="" method="post">
            <p> <input type="submit" name="viewToday" value="View Drugs"></p>
        </form>
        <?php
        if (isset($_POST['viewToday'])) {
            require_once("connect.php");
            echo "<br>";
            $sql = "SELECT * FROM drug";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='view-drugs-container'>";
                echo "<table>";
                echo "<tr><th>Drug</th><th>Formula</th><th>Size</th><th>Company</th><th>ManufacutreDate</th><th>ExpiryDate</th><th>Cost</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['TradeName'] . "</td>";
                    echo "<td>" . $row['Formula'] . "</td>";
                    echo "<td>" . $row['Size'] . "</td>";
                    echo "<td>" . $row['Company'] . "</td>";
                    echo "<td>" . $row['ManufacturingDate'] . "</td>";
                    echo "<td>" . $row['ExpiryDate'] . "</td>";
                    echo "<td>" . $row['Cost'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "No drugs present";
            }
        }
        ?>
        <h2>Add a new drug</h2>
        <form action="" method="post">
            <div class="drugs">
                <div class="left">
                    <p> <label for="drug">Drug Name:</label>
                        <input type="text" name="drug" id="Drug">
                    </p>
                    <p> <label for="Formula">Formula:</label>
                        <input type="text" name="formula" id="Formula">
                    </p>
                    <p> <label for="Size">Size:</label>
                        <input type="text" name="size" id="Size">
                    </p>
                    <p> <label for="Company">Company:</label>
                        <input type="text" name="company" id="Company">
                    </p>
                </div>
                <div class="centre">
                    <p> <label for="ManufactureDate">Manufacturing Date:</label>
                        <input type="date" name="manufacturedate" id="ManufactureDate">
                    </p>
                    <p> <label for="ExpiryDate">Expiry Date:</label>
                        <input type="date" name="expirydate" id="ExpiryDate">
                    </p>
                    <p> <label for="Cost">Cost per unit:</label>
                        <input type="text" name="cost" id="Cost">
                    </p>
                </div>
            </div>
            <input type="submit" name="addDrug" value="Add Drug">
        </form>

        <?php
        if (
            isset($_POST['drug']) && isset($_POST['formula']) && isset($_POST['size']) && isset($_POST['company']) && isset($_POST['manufacturedate']) &&
            isset($_POST['expirydate']) &&  isset($_POST['cost']) && isset($_POST['addDrug'])
        ) {
            require_once("connect.php");
            $drug = $_POST['drug'];
            $formula = $_POST['formula'];
            $company = $_POST['company'];
            $size = $_POST['size'];
            $manufacturedate = $_POST['manufacturedate'];
            $expirydate = $_POST['expirydate'];
            $cost = $_POST['cost'];

            $insertdrug = "INSERT INTO drug (TradeName, Formula, Size, Company, ManufacturingDate, ExpiryDate, Cost) VALUES('$drug','$formula','$size','$company','$manufacturedate','$expirydate','$cost')";
            if ($conn->query($insertdrug)) {
                echo "Drugs added successfully";
            } else {
                echo "Error:" . $conn->error;
            }
        }
        ?>
        <h2>Edit drug details</h2>
        <p>Enter the drug whose details are to be edited</p>
        <form action="" method="post" class="edit_drug_form">
            <div class="form_group" .>
                <p><label for="Drug">Drug Name:</label></p>
                <p><input type="text" name="drug" id="Drug"></p>
                <p>The following details can be edited</p>
                <p><label for="Newdrug">New Drug Name:</label></p>
                <p><input type="text" name="newdrug" id="Newdrug"></p>
                <p><label for="NewSize">New Size:</label></p>
                <p><input type="text" name="newsize" id="NewSize"></p>

                <p>
                    <input type="submit" name="select" value="Update">
                </p>
            </div>
        </form>
        <?php
        if (isset($_POST['drug']) && isset($_POST['newdrug']) && isset($_POST['newsize']) && isset($_POST['select'])) {
            require_once("connect.php");
            $drug = $_POST['drug'];
            $newdrug = $_POST['newdrug'];
            $newsize = $_POST['newsize'];

            $selectid = "SELECT DrugID from drug where TradeName = ?";
            $sql = $conn->prepare($selectid);
            if ($sql) {
                $sql->bind_param('s', $drug);
                $sql->execute();
                $sql->bind_result($id);
                $sql->fetch();

                $sql->close();

                $update = "UPDATE Drug SET TradeName = ?, Size = ? WHERE DrugID = ?";
                $stmt = $conn->prepare($update);
                if ($stmt) {
                    $stmt->bind_param('ssi', $newdrug, $newsize, $id);
                    $stmt->execute();
                } else {
                    echo " Select Error:" . $conn->error;
                }
            } else {
                echo "Update Error:" . $conn->error;
            }
        }

        ?>