<?php 
require_once 'connection.php';


$query = "SELECT * FROM Patients";
$result = mysqli_query($conn,$query);




//$result = dispaly_data();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Patient Records</title>
</head>
<body class="bg-dark">
    <div class="container">
      <div class="row mt-5">
        <div class="col">
          <div class="card mt-5">
            <div class="card-header">
              <h2 class="display-6 text-center">Patient Records</h2>
            </div>
            <div class="card-body">
              <table class="table table-bordered text-center">
                <tr class="bg-dark text-white">
                  <td> PatientSSN </td>
                  <td> FirstName </td>
                  <td> SecondName </td>
                  <td> Address</td>
                  <td> Age</td>
                  <td> Height</td>
                  <td> Weight</td>
                  <td> Allergies</td>
                  <td> PrimaryDoctor</td>
                </tr>
                <tr>
                <?php 

                  while($row = mysqli_fetch_assoc($result))
                  {
                ?>
                  <td><?php echo $row['PatientSSN']; ?></td>
                  <td><?php echo $row['FirstName']; ?></td>
                  <td><?php echo $row['SecondName']; ?></td>
                  <td><?php echo $row['Address']; ?></td>
                  <td><?php echo $row['Age']; ?></td>
                  <td><?php echo $row['Height']; ?></td>
                  <td><?php echo $row['Weight']; ?></td>
                  <td><?php echo $row['Allergies']; ?></td>
                  <td><?php echo $row['PrimaryDoctor']; ?></td>
                  <td><a href="#" class="btn btn-primary">Edit</a></td>  
                  <td><a href="#" class="btn btn-danger">Delete</a></td>  
                </tr>
                <?php    
                  }
                
                ?>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>