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
  </style>
  <link rel="stylesheet" type="text/css" href="webstyles.css">
</head>

<body>
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
          <option value="">Choose your pharmacy</option>
          <?php
          require_once("connect.php");
          $sql = "SELECT PharmacyName from Pharmacy";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($pharmacy = $result->fetch_assoc()) {
              $pharmacyname = $pharmacy['PharmacyName'];
            }
          }
          ?>
          <option value="<?php echo $pharmacyname ?>"><?php echo $pharmacyname ?></option>
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