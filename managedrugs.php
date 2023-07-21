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
        <style>
            p {
                font-size: 25px;

                font-weight: bold;
            }

            body {
                height: 100vh;
                width: 100%;
                background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);
            }

            h2 {
                font-size: 40px;
                color: brown;
                text-align: center;
                margin-bottom: 20px;
            }

            form {
                max-width: 600px;
                margin: 0 auto;
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
            }

            .drugs {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 20px;
            }

            .drugs .left {
                grid-column: 1;
            }

            .drugs .centre {
                grid-column: 2;
            }

            label {
                font-size: 25px;
                color: rgb(93, 20, 20);
                font-weight: bold;
            }

            input[type='text'],
            input[type='date'],
            input[type='number'] {
                width: 50%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            input[type='submit'] {
                width: 40%;
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

            .name {
                float: right;
                color: red;
                font-size: 35px;
                border-color: black;
            }

            .view-drugs-container {
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

            .edit-drug-form {
                max-width: 400px;
                margin: 0 auto;
            }

            .form_group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .form_group[type='text'] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            .form_group input[type='submit'] {
                width: 100%;
                padding: 12px;
                border: none;
                border-radius: 5px;
                background-color: rgb(128, 128, 71);
                color: #fff;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
            }

            .form_group input[type='submit']:hover {
                background-color: rgb(100, 100, 55);
            }

            * {
                margin: 0;
                padding: 0;
                font-family: "montserrat", sans-serif;

            }

            a {
                color: red;
            }

            .username {
                position: absolute;
                top: 0;
                right: 0;
                padding: 10px;
                background-color: antiquewhite;
                border-bottom-right-radius: 10px;
            }

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