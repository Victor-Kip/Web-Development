<html>

<head>
  <title>pharmacist Register</title>
  <style>
    .register select {
      width: 170px;
      padding: 10px;
      font-size: 13px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
      color: #333;
      appearance: none;
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
  </style>
  <link rel="stylesheet" type="text/css" href="webstyles.css">
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
      <button type="button" onclick="window.location.href = 'patlogin.php';">
        Login
      </button>
    </nav>
  </div>
  <h1>Enter your details</h1>
  <div class="register">

    <div class="left">

      <form action=" pharmacistSignup2.php" method="post">
        <p>
          <label for="firstName">First Name:</label>
          <input type="text" name="firstname" id="firstName" />
        </p>
        <p>
          <label for="secondName">Second Name:</label>
          <input type="text" name="secondname" id="secondName" />
        </p>
        <p>
          <label for="socialSecurityNumber">Social Security No:</label>
          <input type="number" name="socialsecuritynumber" id="socialSecurityNumber" />
        </p>
        <label for="Birthdate">Date of Birth</label>
        <input type="date" name="birthdate" id="Birthdate" />

        <p>
          <label for="yearsPractised">Years Practised:</label>
          <input type="number" name="yearspractised" id="yearsPractised" />
        </p>
    </div>
    <div class="centre">
      <p>
        <label for="pharma">Pharmacy:</label>
        <select name="pharma" id="pharma">
          <option value="">Select Pharmacy</option>
          <?php
          require_once("connect.php");
          $sql = "SELECT PharmacyName from Pharmacy";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($pharmacy = $result->fetch_assoc()) {
              $pharmacyname = $pharmacy['PharmacyName'];
              echo '<option value="' . $pharmacyname . '">' . $pharmacyname . '</option>';
            }
          }
          ?>
        </select>
      </p>

      <p>
        <label for="Password">Password:</label>
      <p> <input type="password" name="password" id="password" /></p>
      </p>
      <p>
        <label for="Confirm pass">Confirm password:</label>
        <input type="password" name="confirmpass" id="Confirmpass" />
      </p>
      <input type="submit" value="Sign Up" />
      </form>
    </div>
  </div>
</body>

</html>