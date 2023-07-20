<!DOCYPE html>
    <html>

    <head>
        <title>Consultation</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="consulstyles.css">

        <link rel="preconnect" href="http://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans: ital, wght@0,100; 0,30 0;0,400;0,500; 0,600; 0,700; 1, 100; 1, 200; 1,300; 1,400; 1,500; 1,600;1,700&family=Montserrat: wght@700; 800; 900&display=swap" rel="stylesheet">
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
                <button type="button" onclick="window.location.href = 'patlogin.php';">Login</button>
            </nav>
        </div>



        <div class="container"></div>
        <div class="title">Get a consultation today</div>
        <div class="content">
            <form action="consultation.php" method="POST">
                <div class="user-details">


                    <div class="input-box">
                        <span class="details">Consultation ID</span>
                        <input type="number" name="ConsultationId" placeholder="Enter the consultation number" required>
                    </div>



                    <div class="input-box">
                        <span class="details">Patient SSN</span>
                        <input type="number" name="PatientSSN" placeholder="Enter your PatientSSN" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Doctor SSN</span>
                        <input type="number" name="DoctorSSN" placeholder="Enter the DoctorSSN" required>
                    </div>


                    <div class="input-box">
                        <span class="details">Issue</span>
                        <textarea name="Issue" placeholder="How are you feeling today?" required></textarea>
                    </div>


                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="date" name="CDate" placeholder="The date today" required>
                        <script>
                            let today = new Date().toISOString().subtr(0, 10);
                            document.querySelector("#datepicker").value = today;
                        </script>
                    </div>

                    Remark:<br>
                    <input type="text" name="Remark" hidden>
                    <br>

                    <div class="input-box">
                        <span class="details">Remark</span>
                        <input type="text" name="Remark" hidden>
                    </div>




                    <div class="button">
                        <button name="Submit">Submit</button>
                    </div>

                </div>


            </form>
        </div>
    </body>

    </html>


    <?php
    require_once("connect.php");
    // Add patient
    if (isset($_POST['Submit'])) {


        $ConsultationId = $_POST['ConsultationId'];
        $PatientSSN = $_POST['PatientSSN'];
        $DoctorSSN = $_POST['DoctorSSN'];
        $Issue = $_POST['Issue'];
        $CDate = $_POST['CDate'];
        $Remark = $_POST['Remark'];


        print_r($_POST);

        $query = "INSERT INTO Consultation VALUES ('$ConsultationId', '$PatientSSN','$DoctorSSN','$Issue','$CDate','$Remark')";


        if (mysqli_query($conn, $query)) {
            header("location: ");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }


    $conn->close();
    ?>