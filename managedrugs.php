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
        </style>

    </head>

    <body>
        <div class="username">
            <span class="name"><?php echo $_SESSION['name']; ?></span>
        </div>
        <?php endif; ?><?php ?>

        <h1> Welcome to the Drug Management page.</h1>
        <h2>View available drugs</h2>
        <form action="" method="post">
            <p> <input type="submit" name="viewToday" value="View Submissions"></p>
        </form>
        <?php
        if (isset($_POST['viewToday'])) {
            require_once("connect.php");
            echo "<br>";
            $sql = "SELECT * FROM drug";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Drug</th><th>Formula</th><th>Size</th><th>Company</th><th>ManufacutreDate</th><th>ExpiryDate</th>
            <th>Cost</th></tr>";

                while ($row->fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['TradeName'] . "</td>";
                    echo "<td>" . $row['Formula'] . "</td>";
                    echo "<td>" . $row['Size'] . "</td>";
                    echo "<td>" . $row['Company'] . "</td>";
                    echo "<td>" . $row['ManufacturingDate'] . "</td>";
                    echo "<td>" . $row['ExpiryDate'] . "</td>";
                    echo "<td>" . $row['Cost'] . "</td>";
                    echo "</tr";
                }
                echo "</table>";
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
                    <p> <label for="Size">Formula:</label>
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
                    <input type="submit" name="addDrug" value="Add Drug">
        </form>
        </div>
        </div>
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

            $insertdrug = "INSERT INTO drug VALUES('$drug','$formula','$size','$company','$manufacturedate','$expirydate','$cost')";
            if ($conn->query($insertdrug)) {
                echo "Drugs added successfully";
            } else {
                echo "Error:" . $conn->error;
            }
        }
        ?>
        <h2>Edit drug details</h2>
        <p>Enter the drug whose details are to be edited</p>
        <form action="" method="post"></form>
        <p><label for="Drug">Drug Name:</label></p>
        <p><input type="text" name="drug" id="Drug"></p>
        <p>The following details can be edited</p>
        <p><label for="Newdrug">New Drug Name:</label></p>
        <p> <input type="text" name="newdrug" id="Newdrug"></p>
        </p>
        <p><label for="NewSize">New Size:</label></p>
        <p> <input type="text" name="newsize" id="NewSize">
        </p>
        <p>

            <input type="submit" name="select" value="Update">
        </p>
        <?php
        if (isset($_POST['drug']) && isset($_POST['newdrug']) && isset($_POST['newsize']) && isset($_POST['select'])) {
            require_once("connect.php");
            $drug = $_POST['drug'];
            $newdrug = $_POST['newdrug'];
            $newsize = $_POST['newsize'];

            $selectid = "SELECT DrugID from drug where TradeName = ?";
            $sql = $conn->prepare($selectid);
            if ($sql = $conn->prepare($selectid)) {
                $sql->bind_param('s', $drug);
                $sql->execute();
                $sql->bind_result($id);

                $update = "UPDATE Drug SET TradeName = ?,Size = ? WHERE DrugID = ?";
                if ($prep = $conn->prepare($update)) {
                    $prep->bind_param('ssi', $newdrug, $newsize, $id);
                    $prep->execute();
                }
            }
        }

        ?>