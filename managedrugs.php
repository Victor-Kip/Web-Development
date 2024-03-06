<?php
session_start();
if (isset($_SESSION['AdminSSN'])) {
    $loggedInUser = $_SESSION['AdminSSN'];
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
            <span><?php echo $loggedInUser; ?></span>
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
        <form action="view_drugs.php" method="post" target="blank">
            <p> <input type="submit" name="viewToday" value="View Drugs"></p>
        </form>
        <h2>Add a new drug</h2>
        <form action="http://localhost:3000/drugs" method="post">
            <div class="drugs">
                <div class="left">
                    <p> <label for="drug">Drug Name:</label>
                        <input type="text" name="TradeName" id="Drug">
                    </p>
                    <p> <label for="Formula">Formula:</label>
                        <input type="text" name="Formula" id="Formula">
                    </p>
                    <p> <label for="Size">Size:</label>
                        <input type="text" name="Size" id="Size">
                    </p>
                    <p> <label for="Company">Company:</label>
                        <input type="text" name="Company" id="Company">
                    </p>
                    <p> <label for="image">Photo Link:</label>
                        <input type="text" name="Image" id="Image">
                    </p>
                </div>
                <div class="centre">
                    <p> <label for="ManufactureDate">Manufacturing Date:</label>
                        <input type="date" name="ManufacturingDate" id="ManufactureDate">
                    </p>
                    <p> <label for="ExpiryDate">Expiry Date:</label>
                        <input type="date" name="ExpiryDate" id="ExpiryDate">
                    </p>
                    <p> <label for="Cost">Cost per unit:</label>
                        <input type="text" name="Cost" id="Cost">
                    </p>

                </div>
            </div>
            <input type="submit" name="addDrug" value="Add Drug">
        </form>

        <?php
        if (
            isset($_POST['drug']) && isset($_POST['formula']) && isset($_POST['size']) && isset($_POST['company']) && isset($_POST['manufacturedate']) &&
            isset($_POST['expirydate']) &&  isset($_POST['cost']) && isset($_POST['image']) && isset($_POST['addDrug'])
        ) {
            require_once("connect.php");
            $drug = $_POST['drug'];
            $formula = $_POST['formula'];
            $company = $_POST['company'];
            $size = $_POST['size'];
            $manufacturedate = $_POST['manufacturedate'];
            $expirydate = $_POST['expirydate'];
            $cost = $_POST['cost'];
            $image = $_POST['image'];

            $insertdrug = "INSERT INTO drug (TradeName, Formula, Size, Company, ManufacturingDate, ExpiryDate, Cost,image) VALUES('$drug','$formula','$size','$company','$manufacturedate','$expirydate','$cost','$image')";
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