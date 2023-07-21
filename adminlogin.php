<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="adminlogin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator Login</title>


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





    <div class="login-box">
        <h1>Login</h1>

        <form action="adminlogin.php" method="post">

            <div class="textbox">
                <i class="fa-solid fa-user"></i>
                <input type="number" name="AdminSSN" placeholder="Administrator SSN" required>
                <br>
            </div>

            <div class="textbox">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="Password" placeholder="Password" required>
                <br><br>

            </div>

            <input class="btn" type="submit" name="login" value="Login">
        </form>



        <p><a href="adminreg.php">Don't have an account? Register</a></p>

    </div>


</body>

</html>

<?php
require_once("connect.php");

if (isset($_POST['login'])) {
    $AdminSSN = $_POST['AdminSSN'];
    $Password = $_POST['Password'];

    // Query the database to check if the user exists
    $query = "SELECT * FROM Administrator WHERE AdminSSN='$AdminSSN' AND Password='$Password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        session_start();
        $_SESSION['AdminSSN'] = $AdminSSN;
        header("Location: viewrecords.php"); // Redirect to success page
    } else {
        // Login failed
        echo "<script type = 'text/javascript'>alert('Invalid AdminSSN or password');</script>";
    }
}


?>