<html>

<head>
  <title>Register</title>
</head>

<body>
  <h1>Enter your details</h1>
  <form action="pharmacistSignup2.php" method="post">
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
      <input type="password" name="password" id="password" />
    </p>
    <p>
      <label for="Confirm pass">Confirm password:</label>
      <input type="password" name="confirmpass" id="Confirmpass" />
    </p>
    <input type="submit" value="Sign Up" />
  </form>
</body>

</html>